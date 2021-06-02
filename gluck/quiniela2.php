<?php
@session_start();
require('Connections/Connections.php');
require('include/security.php');
require('include/functions.php');
require('include/redirect.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Gluck</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link href="asset/css/bootstrap.min.css" rel="stylesheet" />
    <link href="asset/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
  </head>
  <body style="    background-color: #010101;
    color: white;">


    <style>
        .line-right {
            border-width: 0 2px 0 0;
            border-style: solid;
            border-color: black;
        }

        .line-right-bottom {
            border-width: 0 2px 2px 0;
            border-style: solid;
            border-color: black;
        }

        .line-bottom {
            border-width: 0 0 2px 0;
            border-style: solid;
            border-color: black;
        }

        .separation {
            margin-top: 121px;
        }

        .separation div div {
            width: 20px;
            height: 48px;
        }

        div.rival {
            height: 48px;
            padding: 12px;
            border: 1px solid #aaa;
            border-top-width: 0;
            font-size: 14px;
            flex-grow: 100;
            text-overflow: ellipsis;
            max-width: 202px;
            overflow: hidden;
            white-space: nowrap;
        }

        div.score {
            height: 48px;
            width: 48px !important;
            text-align: center;
            padding-top: 12px;
            border: 1px solid #aaa;
            border-top-width: 0;
            border-left-width: 0;
            font-size: 14px;
        }

        div.container-step-1 {
            padding: 0;
            margin: 0;
            border: 0 solid #aaa;
            border-top-width: 1px;
        }

        div.container-step-2 {
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        div.container-step-3 {
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        div.container-step-4 {
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        div.container-rival-par {
            border: 0 solid #aaa;
            border-top-width: 1px;
        }

        .step-title {
            height: 70px;
            margin: 25px 0;
            font-size: 14px;
            border: 1px solid #aaa;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;

        p {
            text-align: center;
            margin: 0;
        }
        }

        .col.p-0.d-flex.flex-column {
            max-width: 250px;
        }

        @media (max-width: 570px) {
            .col.p-0.d-flex.flex-column {
                max-width: 100%;
            }

            div.rival {
                max-width: 100%;
            }
        }


        // Modal
           .shield {
               border: 10px solid darkgray;
               border-radius: 50% 50% 50% 50% / 12% 12% 88% 88%;
               position: relative;
               background-image: linear-gradient(128deg, rgb(255 255 255 / 0%) 49%, rgb(224 224 224 / 15%) 49%, rgb(234 234 234 / 61%) 48%, rgb(220 220 220) 81%);

        &-flag {
             position: absolute;
             right: -20px;
             top: -10px;
             border-radius: 50%;
             width: 48px;
             height: 48px;

        span {
            position: absolute;
            border-radius: 50%;
            border: 5px solid darkgray;
            width: 100%;
            height: 100%;
        }

        img {
            max-width: 130%;
            max-height: 130%;
            position: absolute;
            top: -7px;
            left: -7px;
            clip-path: circle(34% at 50% 50%);
        }
        }

        &-name {
             background: linear-gradient(135deg, #af1205 16%, #fb0b0b 35%, #ff2c2c 59%, #f73535 65%, #ca1c05 79%, #310101 100%);
             color: white;
             text-align: center;
             text-transform: uppercase;
             border-radius: 92% 92% 3% 3% / 59% 59% 100% 100%;
             padding: 1rem 0.5rem 0.2rem;
             margin-bottom: 1rem;
             min-height: 102px;
             display: flex;
             justify-content: center;
             align-items: center;

        h2 {
            margin-left: 2px;
            margin-right: 2px;
        }
        }

        &-details {
             margin-bottom: 1rem;

        hr {
            margin-top: 0.7rem;
            margin-bottom: 0.7rem;
            border: 0;
            width: 40%;
            border-bottom: 1px solid rgb(241, 241, 241);
            box-shadow: 0 2px 4px 0 #4c4b4b;
        }

        &__step {
             margin-bottom: 5px;

        p {
            text-align: center;
            text-transform: uppercase;
            line-height: 1.2;
            margin-bottom: 5px;

        span {
            color: red;
        }
        }
        }
        }
        }

        .rival-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    <div _ngcontent-lhe-c136="" class="container-fluid">
        <div _ngcontent-lhe-c136="" class="row mb-2">
            <div _ngcontent-lhe-c136="" class="col p-0 d-flex flex-column">
                <div _ngcontent-lhe-c136="" class="step-title">
                    <p _ngcontent-lhe-c136="">Round of 16<br _ngcontent-lhe-c136="">August 28</p>
                </div>
                <div _ngcontent-lhe-c136="" class="container-step-1">
                    <div _ngcontent-lhe-c136="">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/AM/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Aqui no Estoy</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/AM/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Aqui Estoy</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/AM/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Juan Hidalgo</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/MX/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Chapulin azulado</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/AD/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Por Troya</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/AW/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Jesse Cantante</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/AL/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Enrique Iglesias</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/BD/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Pepito Perez</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/US/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Antonio Banderas</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/AI/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Por Sparta</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/TN/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Juan  Mingoro</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/BD/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Julio Iglesia</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/IT/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Jean Italiano</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/GH/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Ese  tipo</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/WF/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Julia El Macho</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival"><img _ngcontent-lhe-c135="" alt="flag" src="https://www.countryflags.io/AL/flat/24.png">
                                    <!--bindings={
                    "ng-reflect-ng-if": "[object Object]"
                  }--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2">Yornel Marval</span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <!--bindings={
            "ng-reflect-ng-for-of": "[object Object],[object Object"
          }-->
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="separation left">
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right-bottom"></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right-bottom"></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right-bottom"></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right-bottom"></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="separation right">
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="col p-0 d-flex flex-column">
                <div _ngcontent-lhe-c136="" class="step-title">
                    <p _ngcontent-lhe-c136="">Quarterfinals<br _ngcontent-lhe-c136="">May 11</p>
                </div>
                <div _ngcontent-lhe-c136="" class="col container-step-2">
                    <div _ngcontent-lhe-c136="" class="container-rival-par">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="" class="container-rival-par">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="" class="container-rival-par">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="" class="container-rival-par">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <!--bindings={
            "ng-reflect-ng-for-of": "[object Object],[object Object"
          }-->
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="separation left">
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                    <div _ngcontent-lhe-c136="" class="line-right-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                    <div _ngcontent-lhe-c136="" class="line-right-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="separation right">
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="col p-0 d-flex flex-column">
                <div _ngcontent-lhe-c136="" class="step-title">
                    <p _ngcontent-lhe-c136="">Semifinals<br _ngcontent-lhe-c136="">May 11</p>
                </div>
                <div _ngcontent-lhe-c136="" class="col container-step-3">
                    <div _ngcontent-lhe-c136="" class="container-rival-par">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <div _ngcontent-lhe-c136="" class="container-rival-par">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <!--bindings={
            "ng-reflect-ng-for-of": "[object Object],[object Object"
          }-->
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="separation left">
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136="" class="line-right"></div>
                    <div _ngcontent-lhe-c136="" class="line-right-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="separation right">
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136="" class="line-bottom"></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
                <div _ngcontent-lhe-c136="">
                    <div _ngcontent-lhe-c136=""></div>
                    <div _ngcontent-lhe-c136=""></div>
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
            <div _ngcontent-lhe-c136="" class="col p-0 d-flex flex-column">
                <div _ngcontent-lhe-c136="" class="step-title">
                    <p _ngcontent-lhe-c136="">Final<br _ngcontent-lhe-c136="">May 11</p>
                </div>
                <div _ngcontent-lhe-c136="" class="col container-step-4">
                    <div _ngcontent-lhe-c136="" class="container-rival-par">
                        <app-battle-home-step _ngcontent-lhe-c136="" _nghost-lhe-c135="" ng-reflect-match="[object Object]">
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right">
                                    <!--bindings={}-->
                                </div>
                            </div>
                            <div _ngcontent-lhe-c135="" class="d-flex" ng-reflect-ng-class="[object Object]">
                                <div _ngcontent-lhe-c135="" class="rival">
                                    <!--bindings={}--><span _ngcontent-lhe-c135="" class="cursor-pointer pl-2"></span>
                                </div>
                                <div _ngcontent-lhe-c135="" class="score float-right"> </div>
                            </div>
                        </app-battle-home-step>
                    </div>
                    <!--bindings={
            "ng-reflect-ng-for-of": "[object Object]"
          }-->
                </div>
            </div>
            <!--bindings={
        "ng-reflect-ng-if": "[object Object]"
      }-->
        </div>
        <!--bindings={
      "ng-reflect-ng-if": "[object Object]"
    }-->
    </div>





<script src="asset/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="asset/js/core/popper.min.js" type="text/javascript"></script>
<script src="asset/js/core/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>
