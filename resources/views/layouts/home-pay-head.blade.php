<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>SOFT</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- style css -->
      <!-- fevicon -->
      <link rel="icon" href="/assets/home//assets/img/fevicon.png" type="image/gif" />
      <style>
         *, *:before, *:after {
       box-sizing: border-box;
       }
       
       html {
       font-size: 16px;
       }
       
       .plane {
       margin: 20px auto;
       max-width: 300px;
       }
       
       .exit {
       position: relative;
       height: 50px;
       }
       .exit:before, .exit:after {
       content: "EXIT";
       font-size: 14px;
       line-height: 18px;
       padding: 0px 2px;
       font-family: "Arial Narrow", Arial, sans-serif;
       display: block;
       position: absolute;
       background: green;
       color: white;
       top: 50%;
       transform: translate(0, -50%);
       }
       .exit:before {
       left: 0;
       }
       .exit:after {
       right: 0;
       }
       
       .fuselage {
       border-right: 5px solid #d8d8d8;
       border-left: 5px solid #d8d8d8;
       }
       
       ol {
       list-style: none;
       padding: 0;
       margin: 0;
       }

    .pageLoader{
        background: url(/assets/img/logos/loader.gif) no-repeat center center;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 9999999;
        background-color: #ffffff8c;

    }

       
       @-webkit-keyframes rubberBand {
       0% {
         -webkit-transform: scale3d(1, 1, 1);
         transform: scale3d(1, 1, 1);
       }
       30% {
         -webkit-transform: scale3d(1.25, 0.75, 1);
         transform: scale3d(1.25, 0.75, 1);
       }
       40% {
         -webkit-transform: scale3d(0.75, 1.25, 1);
         transform: scale3d(0.75, 1.25, 1);
       }
       50% {
         -webkit-transform: scale3d(1.15, 0.85, 1);
         transform: scale3d(1.15, 0.85, 1);
       }
       65% {
         -webkit-transform: scale3d(0.95, 1.05, 1);
         transform: scale3d(0.95, 1.05, 1);
       }
       75% {
         -webkit-transform: scale3d(1.05, 0.95, 1);
         transform: scale3d(1.05, 0.95, 1);
       }
       100% {
         -webkit-transform: scale3d(1, 1, 1);
         transform: scale3d(1, 1, 1);
       }
       }
       @keyframes rubberBand {
       0% {
         -webkit-transform: scale3d(1, 1, 1);
         transform: scale3d(1, 1, 1);
       }
       30% {
         -webkit-transform: scale3d(1.25, 0.75, 1);
         transform: scale3d(1.25, 0.75, 1);
       }
       40% {
         -webkit-transform: scale3d(0.75, 1.25, 1);
         transform: scale3d(0.75, 1.25, 1);
       }
       50% {
         -webkit-transform: scale3d(1.15, 0.85, 1);
         transform: scale3d(1.15, 0.85, 1);
       }
       65% {
         -webkit-transform: scale3d(0.95, 1.05, 1);
         transform: scale3d(0.95, 1.05, 1);
       }
       75% {
         -webkit-transform: scale3d(1.05, 0.95, 1);
         transform: scale3d(1.05, 0.95, 1);
       }
       100% {
         -webkit-transform: scale3d(1, 1, 1);
         transform: scale3d(1, 1, 1);
       }
       }
       .rubberBand {
       -webkit-animation-name: rubberBand;
       animation-name: rubberBand;
       }
       
       
       * {
           margin: 0;
           padding: 0;
       }
       
       html {
           height: 100%;
       }
       
       /*Background color*/
       #grad1 {
           background-color: : #9C27B0;
           background-image: linear-gradient(120deg, #F02800, #000);
       }

       /*Booking background color*/
       #grad2 {
           background-color: : #9C27B0;
           background-image: linear-gradient(120deg, #F02800, #000);
           border-radius: 50px;
           margin-top: 20px;
           box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
       }

       #grad2 h2{
            color: #fff;
            margin: 5px;
       }

       #grad2 a{
            text-decoration: none;
       }

       .grad2-label{
            height: 30px; 
            margin-right: 99%; 
            margin-bottom: -50%;
            
       }
       
       /*form styles*/
       #paymentForm {
           text-align: center;
           position: relative;
           margin-top: 20px;
       }
       
       #paymentForm fieldset .form-card {
           background: white;
           border: 0 none;
           border-radius: 0px;
           box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
           padding: 20px 40px 30px 40px;
           box-sizing: border-box;
           width: 94%;
           margin: 0 3% 20px 3%;
       
           /*stacking fieldsets above each other*/
           position: relative;
       }


       #paymentForm fieldset .contact-card {
           background: white;
           border: 0 none;
           border-radius: 0px;
           /* box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2); */
           padding: 20px 40px 30px 40px;
           /* box-sizing: border-box; */
           width: 94%;
           margin: 0 3% 20px 3%;
           text-align: left;
       
           /*stacking fieldsets above each other*/
           position: relative;
       }
       
       #paymentForm fieldset {
           background: white;
           border: 0 none;
           border-radius: 0.5rem;
           box-sizing: border-box;
           width: 100%;
           margin: 0;
           padding-bottom: 20px;
       
           /*stacking fieldsets above each other*/
           position: relative;
       }
       
       /*Hide all except first fieldset*/
       #paymentForm fieldset:not(:first-of-type) {
           display: none;
       }
       
       #paymentForm fieldset .form-card {
           text-align: left;
           color: #9E9E9E;
       }
       
       #paymentForm input, #paymentForm textarea {
           padding: 0px 8px 4px 8px;
           border: none;
           border-bottom: 1px solid #ccc;
           border-radius: 0px;
           margin-bottom: 25px;
           margin-top: 2px;
           width: 100%;
           box-sizing: border-box;
           font-family: montserrat;
           color: #2C3E50;
           font-size: 16px;
           letter-spacing: 1px;
       }
       
       #paymentForm input:focus, #paymentForm textarea:focus {
           -moz-box-shadow: none !important;
           -webkit-box-shadow: none !important;
           box-shadow: none !important;
           border: none;
           font-weight: bold;
           border-bottom: 2px solid skyblue;
           outline-width: 0;
       }
       
       /*Blue Buttons*/
       #paymentForm .action-button {
           width: 200px;
           background: #000;
           /* box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2); */
           font-weight: bold;
           color: white;
           border: 0 none;
           border-radius: 20px;
           cursor: pointer;
           padding: 10px 5px;
           margin: 10px 5px;
       }
       
       #paymentForm .action-button:hover, #paymentForm .action-button:focus {
           box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
       }
       
       /*Previous Buttons*/
       #paymentForm .action-button-previous {
           width: 200px;
           background: #000;
           /* box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2); */
           font-weight: bold;
           color: white;
           border: 0 none;
           /* border-radius: 20px; */
           cursor: pointer;
           padding: 10px 5px;
           margin: 10px 5px;
       }
       
       #paymentForm .action-button-previous:hover, #paymentForm .action-button-previous:focus {
           box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
       }
       
       /*Dropdown List Exp Date*/
       select.list-dt {
           border: none;
           outline: 0;
           border-bottom: 1px solid #ccc;
           padding: 2px 5px 3px 5px;
           margin: 2px;
       }
       
       select.list-dt:focus {
           border-bottom: 2px solid skyblue;
       }
       
       /*The background card*/
       .card {
           z-index: 0;
           border: none;
           border-radius: 0.5rem;
           position: relative;
       }
       
       /*FieldSet headings*/
       .fs-title {
           font-size: 20px;
           color: #2C3E50;
           margin-bottom: 20px;
           font-weight: bold;
           text-align: left;
       }
       
       /*progressbar*/
       #progressbar {
           margin-bottom: 30px;
           overflow: hidden;
           color: lightgrey;
       }
       
       #progressbar .active {
           color: #000000;
       }
       
       #progressbar li {
           list-style-type: none;
           font-size: 12px;
           width: 25%;
           float: left;
           position: relative;
       }
       
       /*Icons in the ProgressBar*/
       #progressbar #seat:before {
           font-family: FontAwesome;
           content: "\f007";
       }
       
       #progressbar #personal:before {
           font-family: FontAwesome;
           content: "\f007";
       }
       
       #progressbar #payment:before {
           font-family: FontAwesome;
           content: "\f09d";
       }
       
       #progressbar #confirm:before {
           font-family: FontAwesome;
           content: "\f00c";
       }
       
       /*ProgressBar before any progress*/
       #progressbar li:before {
           width: 50px;
           height: 50px;
           line-height: 45px;
           display: block;
           font-size: 18px;
           color: #ffffff;
           background: lightgray;
           border-radius: 50%;
           margin: 0 auto 10px auto;
           padding: 2px;
       }
       
       /*ProgressBar connectors*/
       #progressbar li:after {
           content: '';
           width: 100%;
           height: 2px;
           background: lightgray;
           position: absolute;
           left: 0;
           top: 25px;
           z-index: -1;
       }
       
       /*Color number of the step and the connector before it*/
       #progressbar li.active:before, #progressbar li.active:after {
           background: skyblue;
       }
       
       /*Imaged Radio Buttons*/
       .radio-group {
           position: relative;
           margin-bottom: 25px;
       }
       
       .radio {
           display:inline-block;
           width: 204;
           height: 104;
           border-radius: 0;
           background: lightblue;
           box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
           box-sizing: border-box;
           cursor:pointer;
           margin: 8px 2px; 
       }
       
       .radio:hover {
           box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
       }

       .selected {
           box-shadow: 1px 1px 2px 2px rgb(0,100,0);
           background-color: #32CD32; */
       }

       .de-selected {
           box-shadow: 1px 1px 2px 2px rgb(128,128,128);
           /* background-color: #FF0000; */
           pointer-events:none;
           /* opacity:0.5; */
       }

       .driver-seat {
           box-shadow: 1px 1px 2px 2px rgb(128,128,128);
           pointer-events:none;
       }

       img:disabled {
        opacity:0.5;
       }
            
       /*Fit image in bootstrap div*/
       .fit-image{
           width: 100%;
           object-fit: cover;
       }


       .bg{
        width: 100%;
            height:auto;
            min-height:100vh;
        background-color: #cccccc;
            background-size: 100% 100%;
            background-position: top center;
            margin:auto;
        }

        .mainRow{

        margin-left: 10%;
        margin-right: 10%;
        }

        p{
        margin:0px; }

        .desc{
        background-color: #f0edeb;
        margin-top: 5%;
        margin-left:0;
        margin-right:50px;
        margin-bottom: 4%;
        }


        .card-body{
            padding:0;
            margin:0;
            margin-top:10%;

        }
        
        div.card.main{
            margin:0px!important;
        }


        .card{
        padding:0!important;
        margin-top:40px;
        }


        .seat-arr{
        /* margin-left: 40px; */
        }

        .trip_item{
        /* margin:3%; */
        color:#000!important
        }

        .heading1{
            margin:5%;
        font-size: 25px;
        }

        .heading2{
            margin:5%;
        margin-top:15%;
        font-size: 20px;
        }

        .payment{
        background-color: #f0edeb;
        padding:3px;
        margin-top: 15%;
        }

        .text1{
        /* color:black;
        font-weight: 700; */
        float: right;
        }
        

        .card-footer{
        background-color: black;
        color:white;
        }

        .purchaseLink{
        text-decoration: none;
        }

        .row1{
        font-size:12px;
        }

        .row2{
        font-weight: 600;
        }

        .subRow{
        margin-left:10%;
        margin-bottom: 2%;
        margin-top:5%;
        }

        p.cardAndExpireValue,p.nameAndcvcValue{
        margin:5%;
        margin-bottom: 10%;
        font-weight: 600;}

        p.nameAndcvc,p.cardAndExpire{
        margin-bottom: -10px;
        }

        .total{
        margin:3%;
        }

        .totalText{
        font-weight: 700;

        }
        .totalText2{
        font-weight: 700;
        font-size:30px;
        }

        .card-img-top {
            width: 100%;
            border-top-left-radius: calc(.25rem - 1px);
            border-top-right-radius: calc(.25rem - 1px);
            height: 430px;
        }




.theme-color{

    color: #F02800;;
}
hr.new1 {
    border-top: 2px dashed #fff;
    margin: 0.4rem 0;
}


.btn-primary {
    color: #fff;
    background-color: #004cb9;
    border-color: #004cb9;
    padding: 12px;
    padding-right: 30px;
    padding-left: 30px;
    border-radius: 1px;
    font-size: 17px;
}


.btn-primary:hover {
    color: #fff;
    background-color: #004cb9;
    border-color: #004cb9;
    padding: 12px;
    padding-right: 30px;
    padding-left: 30px;
    border-radius: 1px;
    font-size: 17px;
}
       
    </style>
    </head>
   </head>
   <nav class="navbar sticky-top navbar-expand-lg shadow-lg p-3 mb-5 rounded" style="width: 100%;  background-color: #F02800;;">
    <div class="container">
       <img src="/assets/img/logo.png" style="width: 100px;"/>
       <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <i class="fa fa-bars"></i>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
            <li class="nav-item" >
                <a class="nav-link" style="color: #fff" href="{{url('/')}}"><i class="fa fa-home"></i>Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" style="color: #fff" href="{{url('/hires/create')}}"><i class="fa fa-bus"></i>Hire Bus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #fff" href="{{url('/my_bookings')}}"><i class="far fa-clone"></i>Bookings</a>
            </li>
        </ul>
       </div>
    </div>
  </nav>