
function logout(rootlib) {
    document.cookie = document.cookie+";expires=Thu, 01 Jan 1970 00:00:01 GMT";
    window.location.href = rootlib;
}
