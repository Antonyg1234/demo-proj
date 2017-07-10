function deleteFunction(id) {
    if(confirm("Are you sure You want to Delete User?")) document.location = 'user/delete?id='+id;
}

function deleteConfig(id) {
    if(confirm("Are you sure You want to Delete Config?")) document.location = 'config/delete?id='+id;
}

function deleteBanner(id) {
    if(confirm("Are you sure You want to Delete Banner?")) document.location = 'banner/delete?id='+id;
}

function deleteCategory(id) {
    if(confirm("Are you sure You want to Delete Category?")) document.location = 'category/delete?id='+id;
}

function deleteProduct(id) {
    if(confirm("Are you sure You want to Delete Product?")) document.location = 'product/delete?id='+id;
}

function deleteCoupon(id) {
    if(confirm("Are you sure You want to Delete Coupon?")) document.location = 'coupon/delete?id='+id;
}

function deleteAddress(id) {
    if(confirm("Are you sure You want to Delete Address?")) document.location = 'site/address/delete?id='+id;
}
function deleteSystem(id) {
    if(confirm("Are you sure You want to Delete Template?")) document.location = 'system/delete?id='+id;
}
function deleteCms(id) {
    if(confirm("Are you sure You want to Delete Cms?")) document.location = 'cms/delete?id='+id;
}