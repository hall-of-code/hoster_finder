function check_confirm_code()
{
    let $code = document.getElementById('confirm_code_input').value;
    if( $code.length >= 5 && /^\d+$/.test($code))
    {
        document.getElementById('confirm_code_form').submit();
    }
}
