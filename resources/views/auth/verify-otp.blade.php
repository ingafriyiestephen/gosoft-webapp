<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SOFT - Verify OTP</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
<style>
body {
    background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), 
                url('/assets/img/passengers_onbus.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 20px;
}

.otp-container {
    width: 100%;
    max-width: 420px;
    margin: 0 auto;
    padding: 20px;
}

.otp-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 0, 0, 0.1);
}

/* Header */
.otp-header {
    background: linear-gradient(135deg, #1f1f1f 0%, #c62828 100%);
    color: white;
    padding: 25px 20px;
    text-align: center;
}

.otp-header h1 {
    font-size: 24px;
    font-weight: 600;
    margin: 0;
}

.otp-header i {
    font-size: 40px;
    margin-bottom: 15px;
    display: block;
}

.otp-header p {
    font-size: 14px;
    margin-top: 8px;
    opacity: 0.9;
}

/* Body */
.otp-body {
    padding: 30px;
}

/* Phone display */
.phone-display {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 25px;
    border-left: 4px solid #c62828;
}

.phone-display strong {
    color: #1f1f1f;
    font-size: 18px;
    display: block;
    text-align: center;
    font-weight: 600;
}

.phone-display small {
    color: #666;
    display: block;
    text-align: center;
    margin-top: 5px;
}

/* OTP Input */
.otp-input-group {
    margin-bottom: 25px;
}

.otp-input-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: block;
}

.otp-input {
    text-align: center;
    font-size: 24px;
    font-weight: 600;
    letter-spacing: 8px;
    padding: 15px;
    height: 60px;
}

.otp-input::placeholder {
    font-size: 16px;
    letter-spacing: normal;
    color: #aaa;
}

/* Timer */
.timer-display {
    text-align: center;
    margin: 20px 0;
    font-size: 14px;
    color: #666;
}

.timer {
    font-weight: 700;
    color: #c62828;
    font-size: 16px;
}

/* Button */
.btn-verify {
    background: linear-gradient(135deg, #1f1f1f 0%, #e53935 100%);
    border: none;
    border-radius: 8px;
    padding: 14px;
    font-size: 16px;
    font-weight: 600;
    color: white;
    transition: all 0.3s;
    width: 100%;
}

.btn-verify:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(229, 57, 53, 0.4);
}

.btn-verify:active {
    transform: translateY(0);
}

.btn-verify:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Resend link */
.resend-link {
    text-align: center;
    margin-top: 20px;
}

.resend-link a {
    color: #c62828;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
}

.resend-link a:hover {
    text-decoration: underline;
}

.resend-link .disabled {
    color: #999;
    cursor: not-allowed;
    text-decoration: none;
}

/* Alerts */
.alert {
    border-radius: 8px;
    border: none;
    padding: 15px;
    margin-bottom: 20px;
}

.alert-success {
    background-color: #e6f4ea;
    color: #1b5e20;
}

.alert-danger {
    background-color: #fdecea;
    color: #b71c1c;
}

.alert ul {
    margin-bottom: 0;
    padding-left: 20px;
}

/* Footer */
.footer-links {
    text-align: center;
    margin-top: 25px;
    font-size: 14px;
    color: #6c757d;
}

.footer-links a {
    color: #c62828;
    text-decoration: none;
    font-weight: 600;
}

.footer-links a:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 576px) {
    body {
        padding: 10px;
    }

    .otp-container {
        padding: 10px;
    }

    .otp-body {
        padding: 20px;
    }
    
    .otp-input {
        font-size: 20px;
        height: 55px;
    }
}

/* OTP input digits styling */
.otp-digit-group {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: 20px 0;
}

.otp-digit {
    width: 50px;
    height: 60px;
    text-align: center;
    font-size: 24px;
    font-weight: 600;
    border: 2px solid #ddd;
    border-radius: 8px;
    background: white;
    transition: all 0.3s;
}

.otp-digit:focus {
    border-color: #c62828;
    box-shadow: 0 0 0 0.2rem rgba(198, 40, 40, 0.25);
    outline: none;
}

.otp-digit.filled {
    border-color: #c62828;
    background: #fff5f5;
}
</style>

</head>
<body>
    <div class="otp-container">
        <div class="otp-card">
            <div class="otp-header">
                <i class="fas fa-shield-alt"></i>
                <h1>Verify OTP</h1>
            </div>
            
            <div class="otp-body">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="phone-display">
                    <strong>{{ $otp_phone_number ?? 'Phone Number' }}</strong>
                    <small>We've sent a 6-digit verification code to this number</small>
                </div>
                
                <form method="POST" action="{{ url('/auth/verify_register_otp') }}" id="otpForm">
                    @csrf
                    
                    <input type="hidden" name="otp_phone_number" value="{{ $otp_phone_number }}">
                    
                    <!-- OTP Input with separate digits -->
                    <div class="otp-input-group">
                        <div class="mb-3">
                            <input 
                                type="text" 
                                name="otp" 
                                id="otp" 
                                class="form-control otp-input" 
                                placeholder="Enter the 6-digit code"
                                maxlength="6"
                                pattern="\d{6}"
                                required
                                autofocus
                            >
                        </div>
                        <input type="hidden" name="full_otp" id="fullOtp">
                    </div>
                    
                    <!-- Timer display -->
                    <div class="timer-display">
                        <i class="fas fa-clock me-1"></i>
                        Code expires in: <span class="timer" id="countdown">05:00</span>
                    </div>
                    
                    <button type="submit" class="btn btn-verify" id="verifyBtn">
                        <i class="fas fa-key me-2"></i>
                        <span id="btnText">Verify & Continue</span>
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                    </button>
                    
                    <div class="resend-link">
                        <p>
                            Didn't receive the code? 
                            <a href="{{ url('/login') }}" id="resendLink">
                                Resend OTP/Use different phone number
                            </a>
                        </p>
                    </div>
                </form>
                
                <div class="footer-links mt-4">
                    <p>
                        <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Back to Home</a>
                    </p>
                    <p class="mt-2">
                        Having trouble? <a href="https://sofrimpongtransport.com/contact-us" target="_blank">Contact Support</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            let timerInterval;
            let totalSeconds = 300; // 5 minutes
            let canResend = false;
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
            
            // Start countdown timer
            startTimer();
            
            // OTP input handling - only allow numbers and limit to 6 digits
            $('#otp').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                
                // Limit to 6 digits
                if (value.length > 6) {
                    value = value.substring(0, 6);
                }
                
                $(this).val(value);
            });
            
            // Handle backspace/delete
            $('.otp-digit').on('keydown', function(e) {
                const index = $(this).data('index');
                
                if (e.key === 'Backspace' || e.key === 'Delete') {
                    if ($(this).val() === '' && index > 1) {
                        // Move to previous input on backspace if current is empty
                        $(`.otp-digit[data-index="${index - 1}"]`).focus().val('').removeClass('filled');
                    } else {
                        $(this).val('').removeClass('filled');
                    }
                    updateFullOtp();
                }
                
                // Allow arrow key navigation
                if (e.key === 'ArrowLeft' && index > 1) {
                    $(`.otp-digit[data-index="${index - 1}"]`).focus();
                }
                if (e.key === 'ArrowRight' && index < 6) {
                    $(`.otp-digit[data-index="${index + 1}"]`).focus();
                }
            });
            
            // Update the hidden full OTP field
            function updateFullOtp() {
                let fullOtp = '';
                $('.otp-digit').each(function() {
                    fullOtp += $(this).val();
                });
                $('#fullOtp').val(fullOtp);
            }
            
            // Form submission handler
            $('#otpForm').submit(function(e) {
                const otp = $('#otp').val();
                
                // Validate OTP - must be exactly 6 digits
                if (!otp || otp.length !== 6 || !/^\d{6}$/.test(otp)) {
                    e.preventDefault();
                    showError('Please enter a valid 6-digit OTP');
                    $('#otp').focus();
                    return;
                }
                
                // Show loading state
                $('#verifyBtn').prop('disabled', true);
                $('#btnText').text('Verifying...');
                $('#loadingSpinner').removeClass('d-none');
            });
            
            // Start timer function
            function startTimer() {
                clearInterval(timerInterval);
                
                timerInterval = setInterval(function() {
                    totalSeconds--;
                    
                    if (totalSeconds <= 0) {
                        clearInterval(timerInterval);
                        $('#countdown').text('00:00');
                        showError('OTP has expired. Please request a new code.');
                        $('#verifyBtn').prop('disabled', true);
                        $('#resendLink').removeClass('disabled');
                        $('#resendTimer').addClass('d-none');
                        return;
                    }
                    
                    const minutes = Math.floor(totalSeconds / 60);
                    const seconds = totalSeconds % 60;
                    
                    $('#countdown').text(
                        minutes.toString().padStart(2, '0') + ':' + 
                        seconds.toString().padStart(2, '0')
                    );
                    
                    // Enable resend after 60 seconds
                    if (totalSeconds <= 240 && !canResend) {
                        canResend = true;
                        startResendTimer();
                    }
                }, 1000);
            }
            
            // Resend timer
            function startResendTimer() {
                let resendSeconds = 60;
                $('#resendTimer').removeClass('d-none');
                $('#resendCountdown').text(resendSeconds);
                
                const resendInterval = setInterval(function() {
                    resendSeconds--;
                    $('#resendCountdown').text(resendSeconds);
                    
                    if (resendSeconds <= 0) {
                        clearInterval(resendInterval);
                        $('#resendTimer').addClass('d-none');
                    }
                }, 1000);
            }
            
            // Function to show error message
            function showError(message) {
                // Remove existing error alerts
                $('.alert-danger').remove();
                
                // Add new error alert
                $('#otpForm').prepend(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    '<i class="fas fa-exclamation-circle me-2"></i>' +
                    message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                    '</div>'
                );
                
                // Auto-hide after 5 seconds
                setTimeout(function() {
                    $('.alert-danger').alert('close');
                }, 5000);
            }
            
            // Auto-focus first OTP input
            $('.otp-digit').first().focus();
            
            // Paste OTP from clipboard
            $('.otp-digit').first().on('paste', function(e) {
                e.preventDefault();
                const pastedData = e.originalEvent.clipboardData.getData('text');
                const digits = pastedData.replace(/\D/g, '').split('').slice(0, 6);
                
                digits.forEach((digit, index) => {
                    if (index < 6) {
                        const input = $(`.otp-digit[data-index="${index + 1}"]`);
                        input.val(digit).addClass('filled');
                    }
                });
                
                updateFullOtp();
                
                // Focus last filled input
                const lastIndex = Math.min(digits.length, 6);
                $(`.otp-digit[data-index="${lastIndex}"]`).focus();
            });
        });
    </script>
</body>
</html>