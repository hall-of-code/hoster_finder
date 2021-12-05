function register_avaible_username()
{
    let $username = document.getElementById('register_form_username').value;
    if($username)
    {
        //todo the API request to api check if username is avaible
        if(getRandomInt(3) >= 2)
        {
            document.getElementById('register_form_username_border').style.borderColor = 'var(--green)';
            document.getElementById('register_form_username').style.color = 'var(--green)';
            document.getElementById('register_form_username_icon').style.color = 'var(--green)';
            document.getElementById('register_form_username_icon').innerHTML = "done";
        }
        else
        {
            document.getElementById('register_form_username_border').style.borderColor = 'var(--red)';
            document.getElementById('register_form_username').style.color = 'var(--red)';
            document.getElementById('register_form_username_icon').style.color = 'var(--red)';
            document.getElementById('register_form_username_icon').innerHTML = "report_problem";
        }
    }
    else
    {
        document.getElementById('register_form_username_border').style.borderColor = 'var(--secondary)';
        document.getElementById('register_form_username').style.color = 'var(--light';
        document.getElementById('register_form_username_icon').style.color = 'var(--light)';
        document.getElementById('register_form_username_icon').innerHTML = "person";
    }
}

function register_avaible_email()
{
    let $email = document.getElementById('register_form_email').value;
    if($email && $email.includes('@'))
    {
        //todo the API request to api check if email is taken
        if(getRandomInt(3) >= 2)
        {
            document.getElementById('register_form_email_border').style.borderColor = 'var(--green)';
            document.getElementById('register_form_email').style.color = 'var(--green)';
            document.getElementById('register_form_email_icon').style.color = 'var(--green)';
        }
        else
        {
            document.getElementById('register_form_email_border').style.borderColor = 'var(--red)';
            document.getElementById('register_form_email').style.color = 'var(--red)';
            document.getElementById('register_form_email_icon').style.color = 'var(--red)';
        }
    }
    else
    {
        document.getElementById('register_form_email_border').style.borderColor = 'var(--secondary)';
        document.getElementById('register_form_email').style.color = 'var(--light';
        document.getElementById('register_form_email_icon').style.color = 'var(--light)';
    }
}

function register_avaible_password()
{
    let $password = document.getElementById('register_form_password').value;
    if($password && $password.length > 11)
    {
        //todo the API request to api check if email is taken
        if(getRandomInt(3) >= 2)
        {
            document.getElementById('register_form_password_border').style.borderColor = 'var(--green)';
            document.getElementById('register_form_password').style.color = 'var(--green)';
            document.getElementById('register_form_password_icon').style.color = 'var(--green)';
        }
        else
        {
            document.getElementById('register_form_password_border').style.borderColor = 'var(--red)';
            document.getElementById('register_form_password').style.color = 'var(--red)';
            document.getElementById('register_form_password_icon').style.color = 'var(--red)';
        }
    }
    else
    {
        document.getElementById('register_form_password_border').style.borderColor = 'var(--secondary)';
        document.getElementById('register_form_password').style.color = 'var(--light';
        document.getElementById('register_form_password_icon').style.color = 'var(--light)';
    }
}

function deactivate_submit()
{
    document.getElementById('submit_button').disabled = true;
    document.getElementById('submit_button').style.opacity = '40%';
    document.getElementById('submit_icon').innerHTML = 'hourglass_top';
}

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}
