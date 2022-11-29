<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <style>
            body{
        Margin: 0;
        padding: 0;
        background-color: #f6f9fc ;
        text-align: center;
    }
    html{
        font-size: 62.5%;
      }
    img{
       border: 0;  
    }
    .wrapper{
        width: 100%;
        table-layout: fixed;
        background-color: #f6f9fc ;
        text-align: center;  
    }
    
    .webkit{
        max-width: 600px;
        background-color: #ffffff ;
        margin: auto;
    }
    .outer{
        Margin:0 auto;
        width: 100%;
        max-width: 600px;
        border-spacing: 0;
        font-family: sans-serif;
        text-align: center
        
    }
    .req{
        width: auto;
        
        margin: 1rem 3rem 4rem;
        font-size: 4rem;
    }
    .lorem{
        width: auto;
        font-size: 2rem;
        
        margin: 0rem 3rem 4rem;
    }
    .tick{
        margin: 3rem 25rem 1rem;
    }
    .issue{
        width: auto;
        
        font-size: 3rem;
    }
    .feel{
        width: auto;
        font-size: 2rem;
        margin: 0rem 3rem 1rem;
    }
    .btn{
        margin: 0rem 25rem 3rem;
        font-size: 1.6rem;
    }
    .connect{
        font-size: 1.8rem;
        color: #ffffff;
        padding: 1.5rem;
        
    }
    .foot{
        background-color:#01418B;
        padding: 1.5px;   
        text-align: center
    }
    .icon{
        width: 3rem;
        margin-bottom: 2rem;
    }
    
    
    .dhan{
        font-size: 2rem;
    }
    
    .unsub{
        font-size: 2rem;
        margin: 1rem 22rem;  
    }
    @media screen and (max-width:600px){
        
    }
    @media screen and (max-width:400px){
        
    }
        </style>
</head>

<body>

    <div class="wrapper">
        <div class="webkit">

            <table class="outer">
                <tr>
                    <td>
                        <table width="100%" style="border-spacing:0;">
                            <tr>
                                <td style="background-color:#01418B;padding:10px;text-align:center">
                                    <img src=" https://drive.google.com/uc?id=1bKG6lyn4ewYJMkFnnEQ4GA0ZlWbiSVyp" style="width:80px" alt="logo" />
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <img src="https://drive.google.com/uc?id=18BEK5y1laB7ZWT3uK36FBmbSqCAePU-0" alt="campus" style="width:600px" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="https://drive.google.com/uc?id=11aTSDo8059RRtgMMiZIZWr8eJ_cbcWvz" alt="done" style="width:100px" class="tick" />
                                    <h1 class="req">Your ISMConnect Recovery Code
                                    </h1>
                                    <p class="lorem">Hello <b>{{$username}} </b>,

                                        Your ISMConnect Recovery Code for your account is : {{$otp}}</p>

                                     <p class="lorem">  Further to keep your account secure, we recommend using a unique password for
                                        your ISMConnect Account & Do not Share this Recovery Code to anyone.

                                        </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h1 class="issue">Any other issues?</h1>
                                    <p class="feel">Please feel free to contact us!</p>
                                    <button type="button" class="btn btn-primary btn-lg">Click here</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="foot">
                                    <p class="connect">Connect with us</p>
                                    <a href="#">
                                        <img src="https://drive.google.com/uc?id=1YCt4yw4AzfGsVKN095rs2whfnJ7MGw3n" alt="facebook" class="icon" />
                                    </a>
                                    <a href="#">
                                        <img src="https://drive.google.com/uc?id=1SQ9CPr72vs1vw5g5dJhPojjx1MmvWVsl" alt="twitter" class="icon" />
                                    </a>
                                    <a href="#">
                                        <img src="https://drive.google.com/uc?id=13VBoTbWXOS5nW3oQSb2XqEANuoe1YVIS" alt="instagram" class="icon" />
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#efefef">
                                    <table style="width:100%; border-spacing:0">
                                        <tr>
                                            <td>

                                                <p class="dhan">IIT ISM Dhanbad, Jharkhand</p>

                                                <a href="#" class="unsub">UNSUBSCRIBE</a>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

            </table>
        </div>
    </div>


</body>

</html>