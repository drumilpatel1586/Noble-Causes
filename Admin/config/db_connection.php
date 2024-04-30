<?php 

$conn = mysqli_connect("localhost","root","","noble_causes");
if (mysqli_connect_errno()) {
    printf("Database not connected", mysqli_connect_error());
}
// else{
//     printf("connection Success");
// }

?>