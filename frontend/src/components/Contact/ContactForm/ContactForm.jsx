import { useState } from "react";

export const ContactFrom = () => {

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: "",
  });

  const [status, setStatus] = useState(""); // Success/Error message

  // Handle input changes
  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  // Handle form submission
  const handleSubmit = async (e) => {
    e.preventDefault();
    
    try {
      const response = await fetch(process.env.NEXT_PUBLIC_API_URL+"/contact", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Authorization": `Bearer ${localStorage.getItem("token")}`, // Example of adding a token
        },
      
        body: JSON.stringify(formData),
      });


      const result = await response.json();
      
      if (response.ok) {
        setStatus("Message sent successfully!");
        setFormData({ name: "", email: "", message: "" }); // Clear form
      } else {
        setStatus("Failed to send message.");
      }
    } catch (error) {
      setStatus("An error occurred. Please try again.");
    }
  };
  return (
    <>
      {/* <!-- BEGIN DISCOUNT --> */}
      <div
        className='discount discount-contacts js-img'
        style={{ backgroundImage: `url('/assets/img/discount-bg3.jpg')` }}
      >
        <div className='wrapper'>
          <div className='discount-info'>
            <span className='saint-text'>write to us</span>
            <span className='main-text'>leave a message</span>
            <p>
              Write to us if you have any questions, we will definitely contact
              you and find a solution.
            </p>
            <form onSubmit={handleSubmit}>
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
                  type='email'
                  name="email"
                  className='form-control'
                  placeholder='Enter your email'
                  onChange={handleChange}
                />
              </div>
              <div className='box-field box-field__textarea'>
                <textarea
                  className='form-control'
                  placeholder='Enter your message'
                  name="message"
                  onChange={handleChange}
                ></textarea>
              </div>
              <button type='submit' className='btn'>
                send
              </button>
            </form>
          </div>
        </div>
      </div>
      {/* <!-- DISCOUNT EOF   --> */}
    </>
  );
};
