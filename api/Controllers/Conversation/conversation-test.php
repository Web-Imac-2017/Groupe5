<?php

include "../../Models/ConversationModel.php";

/*test add message*/
/*ConversationModel::add_message("Ceci est un test", 4, 1);*/

/*test get message from conv*/
/*ConversationModel::get_all_messages_of_conv(1);*/

/*test create conv*/
$test_tab = array("kingofimac", "Jesus");
ConversationModel::create_conv($test_tab);

?>