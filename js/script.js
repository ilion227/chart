var total = [];
var testTickets = [];
var counter;
var colors = [];
var Users = [];
var totalTickets = 0;
var running = false;

function storeMatch( price, winner) {
    console.log("PRICE: " + price);
    console.log("WINNER: " + winner);
    $.ajax({
        url: 'store_match.php',
        type: '',
        data: {
            price: price,
            winner: winner
        },
        success: function(result) {
                var last_id = result['last_id'];
                alert(last_id);
        },
    });
}

function User(userColor, userPrice, userTickets, userLow, userMax) {
    this.userColor = userColor;
    this.userPrice = userPrice;
    this.userTickets = userTickets;
    this.userLow = userLow;
    this.userMax = userMax;
}

function resetVariables() {
    Users = [];
    totalTickets = 0;
}

function changePrice(percent) {
    $("#pointer").css("left", percent + "%" );
}

$(document).ready(function() {
    $("#getData").click(function() {
        $.ajax({
            url: 'data.php',
            data: "",
            dataType: 'json',
            success: function(results) {
                total = [];
                colors = [];
                var sum = 0;

                var u_low = 0;
                var u_max = 0;
                var temp = -1;

                resetVariables();

                $("#spinner").empty();
                $("#data-table").empty();
                $("#percentage-body").empty();

                while(pieChart.segments.length) {
                    pieChart.removeData();
                }

                for ( var i in results) {
                    var result = results[i];

                    total[i] = result['price'];
                    //console.log("Total[" + i + "]= " + total[i]);
                    //console.log("RESULT[" + i + "]= " + result['value']);
                    sum += parseFloat(result['price']);
                }
                //console.log("FIRST SUM: " + sum);
                for ( var i in results) {


                    var result = results[i];

                    var id = result['user_id'];
                    var price = result['price'];
                    colors[i] = result['color'];
                    var label = result['label'];

                    var ticket = price * 100;

                    totalTickets += ticket;

                    u_low = temp;
                    u_max = ticket + u_low;
                    temp = u_max;

                    u_low += 1;

                    Users.push(new User(colors[i], price, ticket, u_low, u_max));

                    $("#data-table")
                        .append("<tr>" +
                            "<td>" + id + "</td>" +
                            "<td>" + price + "</td>" +
                            "<td>" + ticket + "</td>" +
                            "<td>" + colors[i] + "</td>" +
                            "<td>" + label + "</td>" +
                                //"<td><a class='btn btn-danger delete' href=" + "delete.php?id=" + id + ">Delete</a></td>" +
                            "<td><a class='btn btn-danger delete' onClick='deleteItem(" + id + ")'" + ">Delete</a></td>" +
                            "<td><a class='btn btn-primary edit' onClick='editItem(" + id + ")'" + ">Edit</a></td>" +
                            "</tr>");

                    pieChart.addData({
                        value: price,
                        color: colors[i],
                        label: label
                    });
                };
                $("#percentage-body")
                    .append("<tr id='row-color'>" +
                        "<th>Color</th>" +
                        "</tr>" +
                        "<tr id='row-percentage'>" +
                        "<th>Percentage</th>" +
                        "</tr>");

                for ( var i in total) {
                    var num = (total[i] / sum) * 100;

                    console.log("---!- Item Percentage: " + num );


                    $("#row-color").append("<td>" + colors[i] + "</td>");
                    $("#row-percentage").append("<td>" + num.toFixed(2) + "</td>");

                    $("#spinner")
                        .append("<div class='item' style='background-color:" + colors[i]  + ";width:" + num + "%;'>" + Users[i].userTickets + "</div>");

                };

                console.log("Total: " + total.toString());
                console.log("Colors: " + colors.toString());
                console.log("Sum: " + sum);
                console.log("Total tickets: " + totalTickets);
                for (user in Users) {
                    console.log(Users[user]);
                };
            },
            error: function() {
                alert("Not working!");
            }
        });
    });

    $("#getData").click();

    $("#submit").click(function() {

        var price = $("#price").val();
        var color = $("#color").val();
        var label = $("#label").val();

        if (!(price && color && label)){
            alert("Fill all fields!");
            return;
        }


        $.ajax({
            url: 'add.php',
            type: 'POST',
            data: {
                price: price,
                color: color,
                label: label
            },
            success: function(msg) {
                clearInput();
                $("#getData").click();
            }
        });
    });

    $("#edit-button").click(function() {
        var id = $("#edit-id").val();
        var price = $("#edit-price").val();
        var color = $("#edit-color").val();
        var label = $("#edit-label").val();


       $.ajax({
           url: 'edit.php',
           type: 'POST',
           data: {
               id: id,
               price: price,
               color: color,
               label: label
           },
           success: function(msg) {
               $("#editModal").modal('hide');
               $("#getData").click();
           },
           error: function() {
               alert("Couldn't edit");
           }
       });
    });

    $("#action").click(function() {
        if (running == true){
            return
        }
        if (running == false) {
            running = true;
        }
        $("#winner-label").empty();
        var progress = 0;
        var speed = 1;
        var ct = 1000;

        var run = setInterval(request, speed);

        function request() {
            var percent = (progress / 100) * 100;
            changePrice(percent)
            //console.log(ct);
            clearInterval(run);

            if(progress > 100 ) {
                progress = 0;
            }

            speed += 0.00001;
            progress++;
            ct--;

            run = setInterval(request, speed);

            if(ct <= 0) {
                var random = [];
                var winningTicket = 0;
                var winnerPercent = 0;
                var winner;
                var totalPrice = 0;
                clearInterval(run);
                console.log("End of spin: " + totalTickets);
                for( user in Users) {
                    console.log("Tickets: " + Users[user].userTickets);
                    random[user] = Math.floor(Math.random() * (totalTickets));
                }
                console.log("Random numbers: ");
                for ( num in random ) {
                    console.log("Number[" + num + "]= " + random[num]);
                    winningTicket += random[num];
                }
                winningTicket = winningTicket % totalTickets;
                $("#winner").html(winningTicket);
                console.log("Winning ticket: " + winningTicket);

                winnerPercent = (winningTicket / totalTickets) * 100;
                console.log("Winning percent: " + winnerPercent);
                changePrice(winnerPercent);

                winner = 1;
                for ( user in Users) {
                    totalPrice += parseFloat(Users[user].userPrice);
                    var currentTicket = Users[user].userTickets;
                    console.log("User [" + user + "] tickets: " + currentTicket);
                    if(( winningTicket >= Users[user].userLow) && ( winningTicket <= Users[user].userMax)) {
                        winner = user;
                    }
                }
                storeMatch(totalPrice, Users[winner].userColor);

                $("#winner-label")
                    .append("<h2>Winner is <span id='userBox' style='background-color:" + Users[winner].userColor + ";'>"+
                        Users[winner].userColor +"</span></h2>");

                console.log("!-------------------------------------!");
                running = false;
                return;
            }
        }
    });

});

function deleteItem(price_id){
    id = price_id
    $.ajax({
        url: 'delete.php',
        type: 'GET',
        data: {
            id: id
        },
        success: function(msg)
        {
            $("#getData").click();
        },
        error: function() {
            alert("Couldn't delete");
        }
    });
};

function editItem(edit_id) {
    id = edit_id

    $.ajax({
        url: 'view.php',
        type: 'GET',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(results) {
            for ( var i in results) {
                var result = results[i];

                var id = result['user_id'];
                var price = result['price'];
                var color = result['color'];
                var label = result['label'];

                $("#edit-id").val(id);
                $("#edit-price").val(price);
                $("#edit-color").val(color);
                $("#edit-label").val(label);
            };
        },
        error: function() {
            alert("Couldnt get info to edit");
        }
    });

    $("#editModal").modal({
        show: true
    });
}

function clearInput() {
    $("#price").val('');
    $("#color").val('');
    $("#label").val('');
}


