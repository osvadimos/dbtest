
<script type="text/javascript" src="js.js"></script>
<textarea id="terminal" rows="20" cols="100" onkeyup="runCommand();"></textarea>
<script type="text/javascript">
    var db, host, pass, user, tableName, rows;
    document.getElementById('terminal').focus();
    function runCommand() {
        if (window.event.keyCode == 13) {
            var alltext = document.getElementById('terminal').value;
            var allTextArray = alltext.split(/\r\n|\r|\n/g).reverse();
            var command = allTextArray[1];
            var commandArray = command.split(":");

            switch (command) {
                case 'check':
                    checkTables();
                    break;
                case 'add' :
                    addRecords();
                    break;
                case 'connect' :
                    connect();
                    break;
                default :
                    break;
            }
            console.log(commandArray);

            if (commandArray.length > 0) {
                switch (commandArray[0]) {

                    case "password":
                        pass = commandArray[1];
                        connectToDb();
                        break;
                    case "host":
                        host = commandArray[1];
                        document.getElementById('terminal').value = document.getElementById('terminal').value
                                + 'db name:';
                        break;
                    case "username":
                        user = commandArray[1];
                        document.getElementById('terminal').value = document.getElementById('terminal').value
                                + 'password:';
                        break;
                    case "db name":
                        db = commandArray[1];
                        document.getElementById('terminal').value = document.getElementById('terminal').value
                                + 'username:';
                        break;
                    case "table name":
                        tableName = commandArray[1];
                        document.getElementById('terminal').value = document.getElementById('terminal').value
                                + 'number of rows:';
                        break;
                    case "number of rows":
                        numberOfRows = commandArray[1];
                        generateRecords();
                        break;
                }
            }
        }
    }

   
    function addRecords() {
        var alltext = document.getElementById('terminal').value;
        document.getElementById('terminal').value = alltext + 'table name:';
    }

    function connect() {
        var alltext = document.getElementById('terminal').value;
        document.getElementById('terminal').value = alltext + 'host:';
    }

    function connectToDb() {
        $.ajax({
            type: "POST",
            url: "DataBase/index.php",
            data: {
                command: 'connect',
                db: db,
                host: host,
                pass: pass,
                user: user
            },
            success: function(data) {
                if (data !== 'succeeded') {
                    document.getElementById('terminal').value = document.getElementById('terminal').value + 'could not connect' + '\n';
                } else {
                    document.getElementById('terminal').value = document.getElementById('terminal').value + 'connection succeeded' + '\n';
                }
            }
        });
    }

    function checkTables() {
        $.ajax({
            type: "POST",
            url: "DataBase/index.php",
            data: {
                command: 'check',
                db: db,
                host: host,
                pass: pass,
                user: user
            },
            success: function(data) {
                document.getElementById('terminal').value = document.getElementById('terminal').value + data + '\n';

            }
        });
    }
    function generateRecords() {
        $.ajax({
            type: "POST",
            url: "DataBase/index.php",
            data: {
                command: 'add',
                table : tableName,
                rows : numberOfRows,
                db: db,
                host: host,
                pass: pass,
                user: user
            },
            success: function(data) {
                document.getElementById('terminal').value = document.getElementById('terminal').value + data + '\n';

            }
        });
    }




</script>