<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="pump.js?v=<?= time() ?>" type="text/javascript"></script>
        <style>
            input { 
                text-align: right; 
            }
            #contenido{
                width: 100%;
                background: black;
                color: #17ce17;
                font-family: monospace;
                border-radius: 3px;
                padding: 2px;
            }
            .container{
                padding-top: 5px;
            }
        </style>
        <title>Pumps</title>
    </head>
    <body>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>PUMP</h4>
                </div>
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Init</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a>
                        </li>                    
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#help" role="tab">Help ?</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="container">

                                <form>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-sm-3  col-form-label">Coin:</label>
                                        <div class="col-sm-2">
                                            <input id="txtcoin" type="text" class="form-control"/>    
                                        </div>                                    
                                    </div>      
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-sm-3  col-form-label">Multiplier buy:</label>
                                        <div class="col-sm-2">
                                            <input id="txtbuy" type="text" class="form-control" value="1"/>    
                                        </div>                                    
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-sm-3  col-form-label">Amount:</label>
                                        <div class="col-sm-2">
                                            <input id="txtamount" type="text" class="form-control" value="0.0005"/>    
                                        </div>                                    
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-sm-3  col-form-label">Multiplier sell:</label>
                                        <div class="col-sm-2">
                                            <input id="txtsell" type="text" class="form-control" value="1.10"/>    
                                        </div>                                    
                                    </div>  

                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">

                            <div class="container">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-3  col-form-label">API Key:</label>
                                    <div class="col-sm-4">
                                        <input id="txtapik" type="text" class="form-control" value="084af40cca864ace8acdf9430eec6c6b"/>    
                                    </div>                                    
                                </div>    
                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-3  col-form-label">API Secret:</label>
                                    <div class="col-sm-4">
                                        <input id="txtapis" type="text" class="form-control" value="e1d33488b0474e86b5e0ca2fd02f5973"/>    
                                    </div>                                    
                                </div>    
                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-3  col-form-label">Time ms:</label>
                                    <div class="col-sm-2">
                                        <input id="txtmili" type="text" class="form-control" value="350"/>    
                                    </div>                                    
                                </div>                              
                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-3  col-form-label">Iteration:</label>
                                    <div class="col-sm-2">
                                        <input id="txtite" type="text" class="form-control" value="10"/>    
                                    </div>                                    
                                </div>     
                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-3  col-form-label">Total time:</label>
                                    <div class="col-sm-2">
                                        <input id="txttotal" type="text" class="form-control" readonly/>    
                                    </div>                                    
                                </div>  


                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-3  col-form-label">Cancel buy order:</label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" id="chbuy" class="form-check-input" checked>  
                                        <small id="emailHelp" class="form-text text-muted">Before time over.</small>
                                    </div>                                    
                                </div>                              
                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-3  col-form-label">Cancel sell order:</label>
                                    <div class="col-sm-2">                                        
                                        <input type="checkbox" id="chsell" class="form-check-input">  
                                        <small id="emailHelp" class="form-text text-muted">Before time over.</small>
                                    </div>                                    
                                </div>     
                                <div class="form-group row">
                                    <label class="col-lg-2 col-sm-3  col-form-label">
                                        Sell over loss                                        
                                    </label>
                                    <div class="col-sm-2">
                                        <input type="checkbox" id="chosell" class="form-check-input">
                                        <small id="emailHelp" class="form-text text-muted">Negative Multiplier sell.</small>
                                    </div>                                    
                                    <div class="col-sm-2">                                        
                                        <input id="txtosell" type="text" class="form-control" value="0.92"/>   
                                    </div> 
                                </div>  

                            </div>

                        </div>

                        <div class="tab-pane" id="help" role="tabpanel">
                            <div class="container">
                                This bot let you make a fast in-out pump. <br>
                                Requeriments:
                                <ul>
                                    <li>A server with Apache PHP to install server side web services to Bittrex.</li>
                                    <li>Put program files into public folder in your local host.</li>
                                    <li>Open your browser in your local host.</li>
                                    <li>Write your prefer setting and don't forget your API Keys.</li>
                                </ul>
                                For help write me: <a>jose1914luis@gmail.com</a>
                                <br>
                                <b>Donations (BTC): 13rW3xEYLNMW8rSSqoug5UqRzfoseNPJiM</b>
                                <img src="13rW3xEYLNMW8rSSqoug5UqRzfoseNPJiM.png" alt=""/>
                            </div>

                        </div>
                    </div>




                </div>
                <div class="card-footer">
                    <h4>Results:</h4>
                    <div id="contenido"></div>
                </div>
            </div>
        </div>




        <?php
        // put your code here
        ?>
    </body>
</html>
