
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    window.onload = function(){
        
    Swal.fire({
  icon: 'success',
  title: 'Profile Completed',
  text: 'Password has been set for your profile!',

  
}).then((result)=>{
    if(result.value)
    {
        window.location.href="/login";
    }
})
    }
    
    
</script>