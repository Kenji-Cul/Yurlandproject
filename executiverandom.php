<?php 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        min-height: 100vh;
    }

    .account-detail2 {
        position: relative;
    }

    .account-detail2 .flex {
        position: absolute;
        left: 90px;
    }

    .account-detail3 {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 3em;
    }

    .forgot-text {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .account-detail3 p {
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 22px;
        text-align: center;
        color: #eb5757;
    }

    .error {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Space Grotesk";
        font-style: normal;
        font-weight: 600;
        font-size: 18px;
        line-height: 31px;
        text-align: center;
        color: #e11900;
        border: 1px solid #e11900;
        width: 30%;
        padding: 10px 10px;
        background-color: #e1dede;
        visibility: hidden;
    }



    fieldset {
        border: none;
    }

    input {
        width: 2rem;
        height: 2rem;
        font-size: 1rem;
        text-align: center;
        border: none;
        border: 2px solid #808080;
        border-radius: 0.5rem;
        /* background: linear-gradient(145deg, #e6e6e6, #ffffff);
        box-shadow: 28px 28px 56px #d9d9d9, -28px -28px 56px #ffffff; */
    }

    @media only screen and (min-width: 600px) {
        form {
            padding: 4rem 3rem;
        }

        input {
            width: 4rem;
            height: 4rem;
            font-size: 3rem;
        }

        input+input {
            margin-left: 1rem;
        }
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    /* .success {
        width: 60%;
    } */


    /* .error {
        width: 60%;
    } */
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>

        <!-- <div class="nav">
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div> -->
    </header>

    <div class="page-title2">
        <a href="login.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Reset Code</p>
    </div>

    <div class="forgot-text">
        <p>Enter the 6-digit code sent to your email</p>
        <p class="error">Wrong input try again</p>
    </div>


    <section class="login-form-container">
        <form action="" class="login-form" id="login-form" method="">
            <fieldset name='number-code' data-number-code-form>
                <input type="number" min='0' max='9' id="number-code-0" name='number-code-0' data-number-code-input='0'
                    required />
                <input type="number" min='0' max='9' id="number-code-1" name='number-code-1' data-number-code-input='1'
                    required />
                <input type="number" min='0' max='9' id="number-code-2" name='number-code-2' data-number-code-input='2'
                    required />
                <input type="number" min='0' max='9' id="number-code-3" name='number-code-3' data-number-code-input='3'
                    required />
                <input type="number" min='0' max='9' id="number-code-4" name='number-code-4' data-number-code-input='4'
                    required />
                <input type="number" min='0' max='9' id="number-code-5" name='number-code-5' data-number-code-input='5'
                    required />
            </fieldset>

            <button class="btn" type="submit" id="btn">Submit</button>
        </form>


    </section>



    <script>
    // Elements
    const numberCodeForm = document.querySelector('[data-number-code-form]');
    const numberCodeInputs = [...numberCodeForm.querySelectorAll('[data-number-code-input]')];
    let input1 = document.querySelector('#number-code-0');
    let input2 = document.querySelector('#number-code-1');
    let input3 = document.querySelector('#number-code-2');
    let input4 = document.querySelector('#number-code-3');
    let input5 = document.querySelector('#number-code-4');
    let input6 = document.querySelector('#number-code-5');
    let subBtn = document.querySelector("#btn");
    let checkForm = document.querySelector("#login-form");

    checkForm.onsubmit = (e) => {
        e.preventDefault();
    }

    subBtn.onclick = () => {
        let value1 = input1.value;
        let value2 = input2.value;
        let value3 = input3.value;
        let value4 = input4.value;
        let value5 = input5.value;
        let value6 = input6.value;
        var valuearr = [value1, value2, value3, value4, value5, value6];
        var valuestr = valuearr.toString();
        var realvalue = valuestr.replaceAll(',', '');
        const params = new URLSearchParams(window.location.search)
        const unique = params.get('rand')
        const select = params.get('selector')
        if (unique === realvalue) {
            location.href = `resetexecutivepassword.php?select=${select}`;
        } else {
            document.querySelector('.error').style.visibility = "visible";
        }
    }



    // Event callbacks
    const handleInput = ({
        target
    }) => {
        if (!target.value.length) {
            return target.value = null;
        }

        const inputLength = target.value.length;
        let currentIndex = Number(target.dataset.numberCodeInput);

        if (inputLength > 1) {
            const inputValues = target.value.split('');

            inputValues.forEach((value, valueIndex) => {
                const nextValueIndex = currentIndex + valueIndex;

                if (nextValueIndex >= numberCodeInputs.length) {
                    return;
                }

                numberCodeInputs[nextValueIndex].value = value;
            });

            currentIndex += inputValues.length - 2;
        }

        const nextIndex = currentIndex + 1;

        if (nextIndex < numberCodeInputs.length) {
            numberCodeInputs[nextIndex].focus();
        }
    }

    const handleKeyDown = e => {
        const {
            code,
            target
        } = e;

        const currentIndex = Number(target.dataset.numberCodeInput);
        const previousIndex = currentIndex - 1;
        const nextIndex = currentIndex + 1;

        const hasPreviousIndex = previousIndex >= 0;
        const hasNextIndex = nextIndex <= numberCodeInputs.length - 1

        switch (code) {
            case 'ArrowLeft':
            case 'ArrowUp':
                if (hasPreviousIndex) {
                    numberCodeInputs[previousIndex].focus();
                }
                e.preventDefault();
                break;

            case 'ArrowRight':
            case 'ArrowDown':
                if (hasNextIndex) {
                    numberCodeInputs[nextIndex].focus();
                }
                e.preventDefault();
                break;
            case 'Backspace':
                if (!e.target.value.length && hasPreviousIndex) {
                    numberCodeInputs[previousIndex].value = null;
                    numberCodeInputs[previousIndex].focus();
                }
                break;
            default:
                break;
        }
    }

    // Event listeners
    numberCodeForm.addEventListener('input', handleInput);
    numberCodeForm.addEventListener('keydown', handleKeyDown);
    </script>

</body>

</html>