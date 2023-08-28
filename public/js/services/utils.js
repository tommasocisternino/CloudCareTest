const UtilsService = {
    swalMessage: (type, title, message) => {
        Swal.fire({
            icon: type,
            title: title,
            text: message,
        })
    },
    logout : () => {
        AuthService.logout().then((response) => {
                if (response.status === 200) {
                    UtilsService.swalMessage("success", "Logout effettuato", "Reindirizzamento alla pagina di login")
                } else {
                    throw response;
                }
            }
        ).catch(() => {
            UtilsService.swalMessage("error", "Logout già effettuato", "Reindirizzamento alla pagina di login")
        }).finally(() => {
            setTimeout(() => {
                location.href = "/login";
                USER_INFO = null;
            }, 3500)
        })
    }
}
