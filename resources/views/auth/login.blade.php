<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SOFT - Login</title>
    
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

.login-container {
    width: 100%;
    max-width: 420px;
    margin: 0 auto;
    padding: 20px;
}

.login-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 0, 0, 0.1);
}

/* Header */
.login-header {
    background: linear-gradient(135deg, #1f1f1f 0%, #c62828 100%);
    color: white;
    padding: 25px 20px;
    text-align: center;
}

.login-header h1 {
    font-size: 24px;
    font-weight: 600;
    margin: 0;
}

.login-header i {
    font-size: 40px;
    margin-bottom: 15px;
    display: block;
}

/* Body */
.login-body {
    padding: 30px;
}

/* Inputs */
.form-control {
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 16px;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #c62828;
    box-shadow: 0 0 0 0.2rem rgba(198, 40, 40, 0.25);
}

/* Button */
.btn-login {
    background: linear-gradient(135deg, #1f1f1f 0%, #e53935 100%);
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
    color: white;
    transition: all 0.3s;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(229, 57, 53, 0.4);
}

.btn-login:active {
    transform: translateY(0);
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
    margin-top: 20px;
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

    .login-container {
        padding: 10px;
    }

    .login-body {
        padding: 20px;
    }
}
</style>

</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>S.O. FRIMPONG TRANSPORT</h1></br>
                <i class="fas fa-mobile-alt"></i>
                <h1>Sign in with Phone</h1>
            </div>
            
            <div class="login-body">
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
                
                <form method="POST" action="{{ url('/auth/get_otp') }}" id="loginForm">
                    @csrf
                    
                    <div class="mb-3">
                        <input 
                            type="tel" 
                            name="phone_number" 
                            class="form-control" 
                            placeholder="Enter 10-digit phone number (e.g., 0501234567)"
                            required 
                            autofocus
                            maxlength="14"
                            id="phoneInput"
                        >
                        <small class="form-text text-muted mt-1">
                            Enter your 10-digit phone number starting with 0
                        </small>
                    </div>
                    
                    <button type="submit" class="btn btn-login btn-block w-100" id="submitBtn">
                        <i class="fas fa-paper-plane me-2"></i>
                        <span id="btnText">Get OTP</span>
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                    </button>
                </form>
                
                <div class="footer-links mt-4">
                    <p class="mt-2">
                        Need help? <a href="https://sofrimpongtransport.com/contact-us" target="_blank">Contact Support</a>
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
            // Store the clean phone number (without spaces)
            let cleanPhoneNumber = '';
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
            
            // Form submission handler
            $('#loginForm').submit(function(e) {
                // Get the clean phone number (without spaces)
                const phoneDigits = cleanPhoneNumber.replace(/\D/g, '');
                
                // Validate phone number - must be exactly 10 digits and start with 0
                if (!phoneDigits || phoneDigits.length !== 10 || !/^0\d{9}$/.test(phoneDigits)) {
                    e.preventDefault();
                    showError('Please enter a valid 10-digit phone number starting with 0 (e.g., 0501234567)');
                    $('#phoneInput').focus();
                    return;
                }
                
                // Update the input with clean number for submission
                $('#phoneInput').val(phoneDigits);
                
                // Show loading state
                $('#submitBtn').prop('disabled', true);
                $('#btnText').text('Sending OTP...');
                $('#loadingSpinner').removeClass('d-none');
            });
            
            // Phone number formatting - display with spaces but store clean version
            $('#phoneInput').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                
                // Store clean version (just digits)
                cleanPhoneNumber = value;
                
                // Limit to 10 digits
                if (value.length > 10) {
                    value = value.substring(0, 10);
                    cleanPhoneNumber = value;
                }
                
                // Display formatted version with spaces
                let formattedValue = '';
                if (value.length > 0) {
                    if (value.length <= 3) {
                        formattedValue = value;
                    } else if (value.length <= 6) {
                        formattedValue = value.slice(0, 3) + ' ' + value.slice(3);
                    } else if (value.length <= 10) {
                        formattedValue = value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6, 10);
                    }
                }
                
                $(this).val(formattedValue);
            });
            
            // Function to show error message
            function showError(message) {
                // Remove existing error alerts
                $('.alert-danger').remove();
                
                // Add new error alert
                $('#loginForm').prepend(
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
            
            // Focus on phone input
            $('#phoneInput').focus();
            
            // Auto-remove spaces on blur (optional)
            $('#phoneInput').on('blur', function() {
                if (cleanPhoneNumber.length === 10 && cleanPhoneNumber.startsWith('0')) {
                    $(this).val(cleanPhoneNumber);
                }
            });
        });
    </script>
</body>
</html>