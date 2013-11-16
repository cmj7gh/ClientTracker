<?php
class SQLLogComponent extends Component {

  // allow the use of the Auth component to allow for obtaining the
  // logged in username
  public $components = array('Auth');
  private $controller = null;

  // just save the controller, which is needed in the logEvent()
  // method, below
  public function initialize(Controller $c) {
    global $controller;
    $controller = $c;
  }

  // this is the primary logging routine, and it figures out pretty
  // much everything itself.  It's called from
  // AppController::beforeFilter().  It can't be called from
  // afterFilter(), as it will not log the add() or edit() properly
  public function logEvent() {
    global $controller;

    // to get who called this method, we have the controller passed in
    // as the first parameter, as obtaining the controller that calls
    // this component does not seem to be viable (without using some
    // seriously PHP bad coding conventions)

    // to get get the user, call $this->Auth->user('id'); it is the
    // empty string if not logged in.  Can also use 'username' instead
    // of 'id' to get the 'mst3k' format userid.

    // the $reqdata is any additional data to the request, such as
    // which static page is viewed, or the values that were inserted
    // into the DB
    if ( count($controller->request->data) != 0 ) {
      // we remove the password, if it's present in the data to be saved
      $foo = $controller->request->data;
      if ( isset($foo['User']) && isset($foo['User']['password']) )
	$foo['User']['password'] = "[redacted]";
      $reqdata = print_r($foo,true);
    } else if ( ($controller->name == "Pages") && ($controller->view == "display") )
      $reqdata = $controller->passedArgs[0];
    else
      $reqdata = "";

    // what function (post, view, etc.) where they trying to perform?
    $details = "view";
    if ( $controller->request->is('post') )
      $details = "post";
    else if ( $controller->request->is('put') )
      $details = "put";


    // create the $data array to insert into the logs table
    $data = array ('user_id'    => $this->Auth->user('id'),
		   'controller' => $controller->name,
		   'function'   => $controller->view,
		   'details'    => $details,
		   'data'       => $reqdata,
		   'url'        => $controller->request->url,
		   'ipaddr'     => $_SERVER['REMOTE_ADDR'],
		   'theid' => NULL
		   );

    // set the id if it is being viewed, if the edit page is loaded,
    // or if it is deleted.  Note that adding or posting the edit page
    // also have the ID updated via the updateIDForLogEntry() method,
    // below
    if ( (($controller->view == 'view') && ($details == 'view')) || // if one is being viewed…
	 (($controller->view == 'edit') && ($details == 'view')) || // if one is being edited…
	 (($controller->view == 'delete') && ($details == 'post'))) // if one is being deleted…
      $data['theid'] = (isset($controller->passedArgs[0])) ? $controller->passedArgs[0] : NULL;

    // Load the Log model -- I found out about the following command from
    // http://stackoverflow.com/questions/755610/best-practice-in-cakephp-for-saving-data-using-models-in-component
    $log = ClassRegistry::init('Log'); 

    // save the log entry!
    $log->save($data,false);
  }


  // this function is called from AppModel::afterSave(), and updates
  // the ID upon any add() or edit() (but not a view() -- that's done
  // above)
  public static function updateIDForLogEntry ($logentryid, $theid) {
    $log = ClassRegistry::init('Log');
    $logentry = $log->find('first', array('conditions'=>array('Log.id'=>$logentryid)));
    $logentry['Log']['theid'] = $theid;
    $log->save($logentry);
  }

}
