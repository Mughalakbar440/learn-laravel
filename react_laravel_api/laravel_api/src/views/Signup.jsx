import React, { useRef, useState } from "react";
import { Link } from "react-router-dom";
import axiosClient from "../axiosClient";
import { useStateContext } from "../Contexts/ContextProvider";

const Signup = () => {
    const nameRef = useRef();
    const emailRef = useRef();
    const passwordRef = useRef();
    const passwordConfirmationRef = useRef();
    const { setUser, setToken } = useStateContext();

    // State to hold errors
    const [error, setError] = useState(null);

    // Ref for alert box
    const alertbox = useRef(null);

    const onSubmit = (e) => {
        e.preventDefault();
        const payload = {
            name: nameRef.current.value,
            email: emailRef.current.value,
            password: passwordRef.current.value,
            password_confirmation: passwordConfirmationRef.current.value,
        };

        axiosClient.post('/signup', payload)
            .then(({ data }) => {
                setUser(data.user);
                setToken(data.token);
                setError(null); // Clear errors on success

                
                if (alertbox.current) {
                    alertbox.current.style.display = 'none';
                }
            })
            .catch((error) => {
                const response = error.response;
                if (response && response.status === 422) {
                    setError(response.data.errors);
                    // Show alert box if it exists
                    if (alertbox.current) {
                        alertbox.current.style.display = 'block';
                        setTimeout(() => {
                            if (alertbox.current) {
                                alertbox.current.style.display = 'none';
                            }
                        }, 3000);
                    }
                } else {
                    console.error(error);
                }
            });
    };

    return (
        <form method="post" onSubmit={onSubmit}>
            <h1 className="title">Sign up your page</h1>

            {error && (
                <div ref={alertbox} style={{ display: 'none', padding: '10px', marginBottom: '10px', border: '1px solid red', color: 'red', backgroundColor: '#fdd', borderRadius: '4px' }}>
                    {Object.keys(error).map((key) => (
                        <p key={key}>{error[key][0]}</p>
                    ))}
                </div>
            )}

            <input ref={nameRef} type="text" placeholder="Full name" />
            <input ref={emailRef} type="email" placeholder="Email" />
            <input ref={passwordRef} type="password" placeholder="Password" />
            <input
                ref={passwordConfirmationRef}
                type="password"
                placeholder="Confirm Password"
            />
            <button type="submit" className="btn btn-block">
                Sign up
            </button>
            <p className="message">
                Already have an account? <Link to="/login">Log in</Link>
            </p>
        </form>
    );
};

export default Signup;
