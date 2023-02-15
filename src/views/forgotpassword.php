<!DOCTYPE html>
<html>
<head>

  <title>IT Mansala</title>
  <script src="https://kit.fontawesome.com/a87d6dd22b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/student.css">
</head>
<body class="passwordbody">

<div class="forgotpass-section">
    <h3>Reset your password</h3>
        <div class="pass-container">
                <div class="input-field">
                    <h4>OTP Verification</h4>
                    <p>Enter Verifcation code sent to your Email Address</p>
                    <form class="otpboxes">
                        <input id="codeBox1" type="number" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)"/>
                        <input id="codeBox2" type="number" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)"/>
                        <input id="codeBox3" type="number" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)"/>
                        <input id="codeBox4" type="number" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)"/>
                        <p class="otpdisplay" id="show">Send Code</p>
                    </form>
                </div>
                <form>
                    <div class="pass-field">
                        <div class="column1">
                            <p>New password</p>
                        </div>  
                        <div class="column2">
                            <input type="password" class="password-input" name="password1">
                        </div>
                        <div class="column1">
                            <p>Re-enter password</p>
                        </div>  
                        <div class="column2">
                            <input type="password" class="password-input" name="password2">
                        </div>
                        <div class="buttons">
                            <button type="submit" name="resetpassword" class="form-btn">Submit</button>
                            <button type="reset" class="form-btn" id="discard">Discard</button>
                        </div>                    
                    </div>

                </form>

        </div>
    </div> 



<script>
    function getCodeBoxElement(index) {
        return document.getElementById('codeBox' + index);
      }
      function onKeyUpEvent(index, event) {
        const eventCode = event.which || event.keyCode;
        if (getCodeBoxElement(index).value.length === 1) {
          if (index !== 4) {
            getCodeBoxElement(index+ 1).focus();
          } else {
            getCodeBoxElement(index).blur();
            // Submit code
            console.log('submit code ');
          }
        }
        if (eventCode === 8 && index !== 1) {
          getCodeBoxElement(index - 1).focus();
        }
      }
      function onFocusEvent(index) {
        for (item = 1; item < index; item++) {
          const currentElement = getCodeBoxElement(item);
          if (!currentElement.value) {
              currentElement.focus();
              break;
          }
        }
      }
</script>
</body>
</html>
