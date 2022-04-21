<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>Chat App Socket.io</title>

            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
            <!-- Fonts -->
            <!-- CSS only -->
            <style>
                * {
                    margin: 0;
                    padding: 0;
                }
                body {
                    width: 100vw;
                    height: 100vh;
                    margin: 0 auto;
                    background: #27292e;
                }
                .container {
                    width: fit-content;
                    margin: 0 auto;
                }
                .chat-input, input {
                    width: 200px;
                    height: 30px;
                    border: 1px solid black;
                    background: white;
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    padding: 0 15px;
                }
                .chat-content {
                    width: 80vw;
                }
                .chat-content ul {
                    height: calc(95vh - 50px);
                    margin-top: 5vh;
                    overflow-y: scroll;
                    overflow: auto;
                    vertical-align: top;
                }
                .chat-content ul li {
                    display: flex;
                    align-items: center;
                    list-style: none;
                    background: whitesmoke;
                    height: 35px;
                    border-radius: 8px;
                    padding: 0px 10px;
                    
                    
                }
                .chat-content ul li:not(:last-child) {
                    margin-bottom: 20px
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="row chat-row">
                    <div style="display: flex; justify-content: space-around; align-items: center;" class="chat-section">
                        <div style="width: 232px;" class="input-box">
                            <p style="color: white;">Enter your name :</p>
                            <input type="text" name="name" id="user_name">
                            <p style="color: white;">Reciever name :</p>
                            <input type="text" name="name" id="reciever_name">
                        </div>
                        <div class="chat-box">
                            <p style="color: white;">Enter the message:</p>
                        <div class="chat-input bg-primary" id="chatInput" contenteditable="">
                    </div>
                </div>
            </div>
            <div class="chat-content">
                        <ul>
                        
                        </ul>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
            <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>

            <script>

                    
                var name_input = document.querySelector('#user_name');
                name_input.addEventListener('blur' , function(){
                    name = name_input.value;
                });

                var reciever_name_input = document.querySelector('#reciever_name');
                reciever_name_input.addEventListener('blur' , function(){
                    reciever_name = reciever_name_input.value;
                });

                
                
                $(function() {
                    let ip_address = '127.0.0.1';
                    let socket_port = '3000';
                    let socket = io(ip_address + ':' + socket_port);
                    let chatInput = $('#chatInput');
                    
                        
                    chatInput.keypress(function(e) {
                       
                            console.log('ugurlu');

                            let message = $(this).html();
                        console.log(message);
                        if(e.which === 13 && !e.shiftKey) {
                            socket.emit('sendChatToServer',name+" : "+message);
                            $('.chat-content ul').prepend(`<li>${name}: ${message}</li>`)
                            last_li = ul.children[ul.children.length - 1];
                            last_li.scrollIntoView();
                            chatInput.html('');
                            return false;
                        }

                    });
                
                    var chatbox = $("#chat-box");
                    var ul = document.querySelector(".chat-content ul");
                    var last_li;

                    socket.on('sendChatToClient', (message) => {
                        $('.chat-content ul').prepend(`<li>${message}</li>`)
                        
                    });
                    socket.on('sendChatToServer', (message) => {
                        
                        last_li = ul.children[ul.children.length - 1];
                        last_li.scrollIntoView();
                    });
                });

            </script>
        </body>
    </html>