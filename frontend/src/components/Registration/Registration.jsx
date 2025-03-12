import { SocialLogin } from "components/shared/SocialLogin/SocialLogin";
import { useRouter } from "next/router";
import { useState } from "react";

export const Registration = () => {

  const [formData, setFormData] = useState({
    name: "",
    last_name: "",
    phone:"",    
    email: "",
    password: "",
    confirm_password: "",
  });

  const [error, setError] = useState("");
  const navigate = useRouter();

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");

    try {
      const response = await fetch(process.env.NEXT_PUBLIC_API_URL+"/register", {
        method: "POST",
       
        headers: {
          "Content-Type": "application/json",
          "Authorization": `Bearer ${localStorage.getItem("token")}`, // Example of adding a token
        },
        body: JSON.stringify(formData),
        
      });

      const result = await response.json();

      if (result.status) {
        alert("Registration successful! Please login.");
        navigate.push("/login");
      } else {
        setError(result.message || "Registration failed.");
      }
    } catch (error) {
      setError("An error occurred. Try again.");
    }
  };

  return (
    <>
      {/* <!-- BEGIN REGISTRATION --> */}
      <div className='login registration'>
        <div className='wrapper'>
          <div
            className='login-form js-img'
            style={{
              backgroundImage: `url('/assets/img/registration-form__bg.png')`,
            }}
          >
            <form onSubmit={handleSubmit}>
              <h3>register now</h3>
              <SocialLogin />

              <div className='box-field__row'>
                <div className='box-field'>
                  <input
                    type='text'
                    className='form-control'
                    placeholder='Enter your name'
                    name='name'
                    onChange={handleChange}
                  />
                </div>
                <div className='box-field'>
                  <input
                    type='text'
                    className='form-control'
                    placeholder='Enter your last name'
                    name='last_name'
                    onChange={handleChange}
                  />
                </div>
              </div>
              <div className='box-field__row'>
                <div className='box-field'>
                  <input
                    type='tel'
                    className='form-control'
                    placeholder='Enter your phone'
                    name='phone'
                    onChange={handleChange}
                  />
                </div>
                <div className='box-field'>
                  <input
                    type='email'
                    className='form-control'
                    placeholder='Enter your email'
                    name='email'
                    onChange={handleChange}
                  />
                </div>
              </div>
              <div className='box-field__row'>
                <span>password</span>
                <div className='box-field'>
                  <input
                    type='password'
                    className='form-control'
                    placeholder='Enter your password'
                    name='password'
                    onChange={handleChange}
                  />
                </div>
                <div className='box-field'>
                  <input
                    type='password'
                    className='form-control'
                    placeholder='Confirm password'
                    name='confirm_password'
                    onChange={handleChange}
                  />
                </div>
              </div>
              <label className='checkbox-box checkbox-box__sm'>
                <input type='checkbox' />
                <span className='checkmark'></span>
                Remember me
              </label>
              <button className='btn' type='submit'>
                registration
              </button>
              <div className='login-form__bottom'>
                <span>
                  Already have an account?{' '}
                  <a onClick={() => navigate.push('/login')}>Log in</a>
                </span>
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
      {/* <!-- REGISTRATION EOF   -->  */}
    </>
  );
};
