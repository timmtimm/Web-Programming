function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validateForm()
{
    // Validasi nama
    if(document.getElementById("name").value == "")
    {
        swal({
            title: "Mohon melengkapi nama pada formulir",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }
    else
    {
        const regex = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        if (regex.test(document.getElementById("name").value))
        {
            swal({
                title: "Mohon nama formulir ditulis dengan benar",
                confirmButtonText: "Konfirmasi",
                confirmButtonColor: "#DB3644",
            });
            return false;
        }
    }
    

    // Validasi NRP
    if(document.getElementById("nrp").value == "")
    {
        swal({
            title: "Mohon melengkapi NRP pada formulir",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }

    const regex = /^\d+$/;
    if (!regex.test(document.getElementById("nrp").value))
    {
        swal({
            title: "Mohon NRP ditulis dengan benar",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }

    if (document.getElementById("nrp").value.length == 10 && document.getElementById("nrp").value.length == 14)
    {
        swal({
            title: "Mohon NRP ditulis dengan benar",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }

    // Validasi Email
    if(document.getElementById("email").value == "")
    {
        swal({
            title: "Mohon melengkapi Email pada formulir",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }
    
    if(!isEmail(document.getElementById("email").value))
    {
        swal({
            title: "Mohon Email ditulis dengan benar",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }

    // Validasi Alamat
    if(document.getElementById("alamat").value == "")
    {
        swal({
            title: "Mohon melengkapi alamat pada formulir",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }

    // Validasi Departemen
    if(document.getElementById("departemen").selectedIndex < 1)
    {
        swal({
            title: "Mohon dipilih departemen pada formulir",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }
  
    // Validasi Vaksin
    if(document.getElementById("vaksin").selectedIndex < 1)
    {
        swal({
            title: "Mohon dipilih status vaksinasi pada formulir",
            confirmButtonText: "Konfirmasi",
            confirmButtonColor: "#DB3644",
        });
        return false;
    }
    
    swal({
        title: "Terima kasih telah mengisi pendataan Vaksinasi",
        confirmButtonText: "Konfirmasi",
        confirmButtonColor: "#449D44",
    });
    document.formulir.reset();
    return false;
}