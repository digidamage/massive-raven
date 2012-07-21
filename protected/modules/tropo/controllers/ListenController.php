<?php


class ListenController extends Controller {

	private $_message;
	private $_caller;
	private $_called;

	public  $tropo;


	public function actionIndex() {
		

		try {
		  // If there is not a session object in the POST body,
		  // then this isn't a new session. Tropo will throw
		  // an exception, so check for that.
		  $session = new Session();
		} catch (TropoException $e) {
		  // This is a normal case, so we don't really need to 
		  // do anything if we catch this.
		}

		$this->tropo = new Tropo();
		// Get caller details
		$this->_caller = $session->getFrom();
		$this->_called = $session->getTo();

		// $caller now has a hash containing the keys: id, name, channel, and network
		#$caller['id'];

		// $called now has a hash containing the keys: id, name, channel, and network
		#$called['id'];

		if ($this->_called['channel'] == "TEXT") {

		  // Text greeting
		  $this->tropo->say("Welcome to Text Roulette!\nAt any point to stop getting text simply type STOP or s!");
  		  #$this->tropo->say("At any point to stop getting text simply type STOP or s!");
		  $this->tropo->say("Text back START or s? to get connected");
		  print $this->tropo;

		  // Get text
		  $this->_message = $session->getInitialText();
		  #$this->tropo->say("You said " . $this->_message);

		  // Look for command
		  $this->_messageCommands();


		
		} else {

		  // This is a phone call
		  $this->tropo->say("www dot media chains dot com");

		}

		print $this->tropo;
		#Yii::app()->end(); 
	}

	/* Interpret user commands */
	private function _messageCommands() {

		// START
 		if($_message == "START" || $_message == "S?") {
			// Send Snap exit greeting 
			$this->snapResponse();

			// Search records for CidVcid 
			// @TODO Append column to table called session id for tracking
			// $post=new Post;
			$CidVcid = CidVcid::model()->find('cid=:cid', array(':cid'=>$this->_called['id']));

			if(is_null($CidVcid)) {
		      $model = new CidVcid;

		      $model->cid = $this->_caller['id'];
		      $model->status = 1; // ACTIVE	

		      if($model->save()) {
		      	// Search for random partner
		      }
			}
		}

		// STOP
 		if($_message == "STOP" || $_message == "S!") {
			// Send Snap exit greeting 
			$this->snapResponse();

			// Search records for CidVcid
			$CidVcid = CidVcid::model()->find('cid=:cid', array(':cid'=>$this->_called['id']));
			$CidVcid->status = 0; // DEACTIVE
			$CidVcid->save();

		}


/*
			case 'NEXT':
				// Send Snap exit greeting 
				$this->snapResponse();
				break;
			case 'N?':
				// Send Snap exit greeting 
				$this->snapResponse();
				break;


			case 'HELP':
				// Send Snap exit greeting 
				$this->snapResponse();
				break;
			case 'H?':
				// S5end Snap exit greeting 
				$this->snapResponse();
				break;


			case 'STOP':
				// Send Snap exit greeting 
				$this->snapResponse();
				break;
			case 'S!':
				// Send Snap exit greeting 
				$this->snapResponse();
				break;
 */
		

		
	}

	/* This will look at the _message property and determine response */
	public function snapResponse() {

		// START / HELP(FIRST TIME)
 		if($_message == "START" || $_message == "S?") {
			$this->tropo->say("Starting Text Roulette!");
			$this->tropo->say("To rotate type \"NEXT\" or \"n?\" ");
			print $this->tropo;
		}

		// STOP
 		if($_message == "STOP" || $_message == "S!") {
			$this->tropo->say("Stopping Text Roulette!");
			$this->tropo->say("We will miss you! :(");
			print $this->tropo;

		}

		// NEXT
		// GREETING
		// HELP
		#$respSnap = array();


	}

}