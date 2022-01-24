async function fetchAttrCountJSON(attr_id) {
    let url = "http://localhost/vr-boot/set-type-vr-view/" + attr_id;
    //let url = "https://lanexanginfo.com/vr-boot/set-type-vr-view/" + attr_id;
    const response = await fetch(url);
    const resJSON = await response.json();
    return resJSON;
}
fetchAttrCountJSON("61d85ed74a41313a64469803").then(function(resJSON) {
    //console.log(resJSON);
    //check if the attraction is already in the cart
    if (resJSON.status == 200) {
        console.log(resJSON.message);
    }
});