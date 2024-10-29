import React from "react";
import { Navigate, NavigationType, Outlet } from "react-router-dom";
import { useStateContext } from "../Contexts/ContextProvider";
const GuestLayout = () => {
    const { token } = useStateContext();
    if (token) {
        return <Navigate to="/" />;
    }

    return (
        <div>
            <div className="login-signup-form animated fadeInDown">
                <div className="form">
                    <Outlet />
                </div>
            </div>
        </div>
    );
};

export default GuestLayout;
