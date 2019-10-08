<?php
//基于websocket 聊天室
//创建服务
$ws=new swoole_websocket_server("0.0.0.0",9501);
//建立连接 $ws 服务 $request 客户端
$ws->on('open',function($ws,$request){
	echo "建立连接";
}); 

//接收消息 $request->data 接收的消息
$ws->on("message",function($ws,$request){
	var_dump($ws);
	//遍历连接websocket的每个客户端
	foreach($ws->connections as $key=>$fd){
		//反馈信息给客户端
		$ws->push($fd,$request->data);
	}
	
});

//关闭连接
$ws->on('close',function($ws,$request){
	echo "连接关闭";
});
//启动服务
$ws->start(); 
 ?>