angular.module( "main-ui", [] )
    .controller( 'main', function( $scope ){
        $scope.id = 0;
        $scope.wid = 0;
        $scope.count = 0;
        $scope.count_balls = 0;
        $scope.attempt = 1;

        /**
         * Проверка имени и загрузка первого вопроса
         */
        $scope.start = function (){

            var value = $(".step1 input[name=name]").val();

            if( value ){
                $(".step1 .form-group").removeClass("has-error");
                $(".errorBlock").hide(200);

                var xhr = new XMLHttpRequest();
                xhr.open("post", baseUrl +"site/start", false );
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send( 'name='+value );

                if (xhr.status != 200) {
                    $(".errorBlock").text("Произошла ошибка, попробуйте заново").show(200);
                } else {
                    var res = JSON.parse( xhr.responseText );
                    if( res.error )$(".errorBlock").text( res.error ).show(200);
                    if( res.id >0 ){
                        $scope.id = res.id;

                        $(".step1").hide( 200, function(){
                            $(".step2").show( 200 );
                            $(".panelInfo").show( 600 );
                        });

                        if( res.question && res.question.answers.length >0 && res.question.info ){
                            $scope.wid = res.question.info.id;
                            setQuestion( res.question.info.name, res.question.answers );
                        }
                        else
                            $(".errorBlock").text("Error server response").show(200);
                    }
                }
            }
            else{
                $(".form-group").addClass("has-error");
                $(".errorBlock").text("Необходимо ввети имя").show(200);
            }
        };

        /**
         * Проверка ответа и загрузка следующего вопроса
         */
        $scope.nextQuestion = function(){
            var answer = $(".step2 input[name=answer]:checked").val();
            if( answer > 0 && $scope.wid > 0 ){
                var xhr = new XMLHttpRequest();
                xhr.open("get", baseUrl +"site/answer?id="+$scope.id+"&wid="+$scope.wid+"&answer="+answer, false );
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send( );

                if (xhr.status != 200) {
                    $(".errorBlock").text("Error, try again please").show(200);
                }
                else {
                    var res = JSON.parse( xhr.responseText );
                    if( res.result ){
                        $(".errorBlock").hide(200);
                        $scope.count_balls++;
                        $scope.count++;
                        if( res.question && res.question.answers.length >0 && res.question.info ){
                            $scope.attempt = 1;
                            $scope.wid = res.question.info.id;
                            setQuestion( res.question.info.name, res.question.answers );
                        }
                        else {
                            $(".errorBlock").hide(200);
                            $(".panelInfo").hide(200);
                            $(".step2").hide(200);
                            $(".okBlock").text("Вы молодец, Ваш тест успешно пройден. Ваш бал: "+$scope.count_balls).show(200);
                        }
                    }
                    else {
                        if( $scope.attempt < 3 ){
                            $scope.attempt++;
                            $(".errorBlock").text("Вы выбрали неправильный ответ").show(200);
                        }
                        else {
                            $(".step2").hide( 200, function(){
                                $(".errorBlock").text("Вы провалили тест").show(200);
                            });
                        }
                    }
                }
            }
            else {
                $(".errorBlock").text("You need select the answer").show(200);
            }
        }
    });

function setQuestion( question, answers ){
    $(".step2 .panel-heading").text( question );
    var htmlAnswer='';
    answers.forEach( function( feild, value ){
        htmlAnswer += '<li><input type="radio" name="answer" value="'+feild.id+'" id="value_'+feild.id+'" />&nbsp;<label for="value_'+feild.id+'">'+feild.name+'</label></li>';
    });

    $(".step2 .panel-body ul").html( htmlAnswer );
}