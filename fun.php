<?php 
session_start();

//connection banaya hai yaha pr 
$connect = mysqli_connect('localhost','root','','parking');

function insert($table,$data){
    global $connect;
    $col = implode(",",array_keys($data));
    $rows = implode("','",array_values($data));

   return $query = mysqli_query($connect,"insert into $table ($col) value ('$rows')");

}

//calling function
function calling($table,$order_by){
    global $connect;
    $dabba = [];

    $query = mysqli_query($connect,"select * from $table $order_by");

    while($glass = mysqli_fetch_array($query)){
        $dabba[] = $glass;
    }
    return $dabba;
}

function view($table,$cond){
    global $connect;
    $query = mysqli_query($connect,"select * from $table WHERE $cond");
    $glass = mysqli_fetch_array($query);
    return $glass;
}

function search($table,$cond){
    global $connect;
    $array = [];
    $query = mysqli_query($connect,"select * from $table WHERE $cond");
    while($glass = mysqli_fetch_array($query)){
        $array[] = $glass;
    }
    return $array;
}

function update($table,$fields,$condition){
    global $connect;
    $query = mysqli_query($connect,"UPDATE $table  SET $fields WHERE $condition");

    return ($query)? true : false;
}

function check($table,$cond){
    global $connect;
    $query = mysqli_query($connect,"select * from $table WHERE $cond");
    $count = mysqli_num_rows($query);
    
    if($count > 0){
        return true;
    }    
    else{
        return false;
    }
}

 function send($to, $message) 
    {
        $authKey = "255108AsWkIhuXpb5c3026c8";
        $senderID = "CWSTXT";
        $message = urlencode($message);

        $route = "4";

            $postData = '{
                "sender": "'.$senderID.'",
                "route": "'.$route.'",
                "country": "91",
                "sms": [
                    {
                        "message": "'.$message.'",
                        "to": [
                            "'.$to.'"
                        ]
                    }
                ]
            }';        

            //API URL
            $url="http://api.msg91.com/api/v2/sendsms";

            // init the resource
            $ch = curl_init();
            curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

            // CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "authkey: $authKey",
                "content-type: application/json"),
            ));

            //get response
            $response = curl_exec($ch);
            $err = curl_error($ch);
            
            curl_close($ch);

            if ($err) {
              echo "cURL Error #:" . $err;
            }
            else
            {
                $result = json_decode($response);

                if ($result->type === "success"){
                    return TRUE;
                }
                else{

                    return FALSE;
                }        
            }

        }       



?>