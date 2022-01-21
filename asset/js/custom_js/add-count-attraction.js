async function fetchAttrCountJSON(attr_id) {
    let url = "http://localhost/vr-destination/preview-attraction-count/" + attr_id;
    //let url = "https://lanexanginfo.com/vr-destination/preview-attraction-count/" + attr_id;
    const response = await fetch(url);
    const resJSON = await response.json();
    return resJSON;
}

fetchAttrCountJSON("61d91a0bef77000098007777").then(function(resJSON) {
    console.log(resJSON);
    //check if the attraction is already in the cart
    if (resJSON.status == 200) {
        console.log(resJSON.message);
    }
});