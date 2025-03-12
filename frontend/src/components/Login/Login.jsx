import { useRouter } from "next/router";
import { useState } from "react";

export const Login = () => {

  const [formData, setFormData] = useState({
      email: "",
      password: "",
    });
  
    const [error, setError] = useState("");
    const navigate = useRouter(); // To redirect after login
  
    // Handle input changes
    const handleChange = (e) => {
      setFormData({ ...formData, [e.target.name]: e.target.value });
    };
  
    // Handle form submission
    const handleSubmit = async (e) => {
      e.preventDefault();
      setError("");
  
      try {
        const response = await fetch(process.env.NEXT_PUBLIC_API_URL+"/login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${localStorage.getItem("token")}`, // Example of adding a token
          },
          body: JSON.stringify(formData),
        });
  
        const result = await response.json();
        if (result.status) {
          localStorage.setItem("token", result.access_token); // Store token
          navigate.push("/"); // Redirect after login
        } else {
          setError(result.message || "Login failed");
        }
      } catch (error) {
        setError("An error occurred. Try again.");
      }
    };
  return (
    <>
      {/* <!-- BEGIN LOGIN --> */}
      <div className='login'>
        <div className='wrapper'>
          <div
            className='login-form js-img'
            style={{ backgroundImage: `url('/assets/img/login-form__bg.png')` }}
          >
            <form  onSubmit={handleSubmit}>
              <h3>log in </h3>

              <div className='box-field'>
                <input
                  type='text'
                  className='form-control'
                  placeholder='Enter your email or nickname'
                  name ='email'
                  onChange={handleChange}
                />
              </div>
              <div className='box-field'>
                <input
                  type='password'
                  className='form-control'
                  name='password'
                  placeholder='Enter your password'
                  onChange={handleChange}
                />
              </div>
              <label className='checkbox-box checkbox-box__sm'>
                <input type='checkbox' />
                <span className='checkmark'></span>
                Remember me
              </label>
              <button className='btn' type='submit'>
                log in
              </button>
              <div className='login-form__bottom'>
                <span>
                  No account?{' '}
                  <a onClick={() => navigate.push('/registration')}>
                    Register now
                  </a>
                </span>
                <a href='#'>Lost your password?</a>
              </div>
            </form>
          </div>
        </div>
        <img
          className='promo-video__decor js-img'
          src='/assets/img/promo-video__decor.jpg'
          alt=''
        />
      </div>
      {/* <!-- LOGIN EOF   --> */}
    </>
  );
};
