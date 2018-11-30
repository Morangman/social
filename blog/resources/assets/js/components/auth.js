export default{
    register(context, name, phone, email, password, password_confirmation){
        axios.post(
            'register',
            {
                name: name,
                email: email,
                phone: phone,
                password: password,
                password_confirmation: password_confirmation
            }).then(response => {
                if(response.status === 200){
                    context.response = response.data.message
                    console.log( response.data.message)
                }
            }, response =>{
                context.response = response.data
                context.error = true
            }
            
            )
    }
}