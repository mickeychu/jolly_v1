<?php
	 
	class chat{
		
		private $chat_id;
		private $user_id;
		private $message;
		
		public function getChatID(){
			return $this->chat_id;
			}
		public function setChatID($chat_id){
			$this->chat_id = $chat_id;
			}
		
		public function getUserID(){
			return $this->user_id;
			}
		public function setUserID($user_id){
			$this->user_id = $user_id;
			}
		
		public function getMessage(){
			return $this->message;
			}
		public function setMessage($message){
			$this->message = $message;
			}
			
		public function insertMessage($user_id, $message){
			require "scripts/connect.php";
			$query = mysqli_query($link, "INSERT INTO `chat` (`chat_id`, `user_id`, `message`) VALUES (NULL, '$user_id', '$message');") 
					 or die(mysqli_error($link));
			}
		}
?>