function check_tan_code()
{
    let $code = document.getElementById('tan_code_input').value;
    if( $code.length >= 4 && /^\d+$/.test($code))
    {
        document.getElementById('tan_code_form').submit();
    }
}
