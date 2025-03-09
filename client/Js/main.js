const signUpAlert = document.getElementById('signUpAlert');
const signUpAlertContainer = document.getElementById('signUpAlertContainer');


document.addEventListener('DOMContentLoaded', () => {
    if (document.body.id === 'signUp') {
        document.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);

            const response = await axios.post('http://localhost/article_FAQs/server/apis/v1/signup.php',
                formData, {
                    headers: {
                        'Content-Type' : 'application/json'
                    }
                }
            )

            const result = response.data;

            console.log(typeof(result));
            console.log(result);

            if (result.status === 'success'){
                window.location.href = 'http://localhost/article_FAQs/client/index.html'
            } else {
                console.log(result.message);
                signUpAlert.textContent = result.message;
                signUpAlertContainer.style.display = 'block';
            }
        })
    }

    if (document.body.id === 'signIn') {
        document.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);

            const response = await axios.post('http://localhost/article_FAQs/server/apis/v1/signin.php',
                formData, {
                    headers: {
                        'Content-Type' : 'multipart/form-data'
                    }
                }
            ) 

            const result = response.data;
            console.log(result);

            if(result.status === 'success') {
                window.location.href = 'http://localhost/article_FAQs/client/home.html'
            } else {
                console.log(result.message);
                signUpAlert.textContent = result.message;
                signUpAlertContainer.style.display = 'block';
            }
        })
    }

    if (document.body.id === 'addQuestion') {
        document.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);

            const response = await axios.post('http://localhost/article_FAQs/server/apis/v1/addQuestion.php',
                formData , {
                    headers: {
                        'Content-Type' : 'multipart/form-data'
                    }
                } 
            )

            const result = response.data;
            console.log(result);

            if (result.status === 'success'){
                window.location.href = 'http://localhost/article_FAQs/client/home.html';
            } else {
                console.log(result.message);
                signUpAlert.textContent = result.message;
                signUpAlertContainer.style.display = 'block';
            }
        })
    }
})