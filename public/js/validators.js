var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var passwordRegex = /^(?=.* [A - Z])(?=.* [0 - 9])(?=.* [!@#\$ %\^&\*]) (?=.{ 8,})/;
var emptyText = /^\s*$/;

function isEmailOk(email)
{
    return (emailRegex.test(email)); 
} 

function isPasswordOk(password) 
{
    return (passwordRegex.test(password));
} 

function isNotEmpty(text) 
{
    return (!emptyText.test(text));
} 

