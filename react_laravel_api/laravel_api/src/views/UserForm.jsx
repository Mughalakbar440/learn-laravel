import React, { useEffect, useState } from "react";
import { Form, useNavigate, useParams } from "react-router-dom";
import AxiosClient from "../axiosClient";
import { useStateContext } from "../Contexts/ContextProvider";

const UserForm = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const {setNotification} =    useStateContext();
    const [user, setUser] = useState({
        id: null,
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });
    if (id) {
        useEffect(() => {
            setLoading(true);
            AxiosClient.get(`/users/${id}`)
                .then(({ data }) => {
                    setLoading(false);
                    setUser(data);
                })
                .catch(() => {
                    setLoading(false);
                });
        }, []);
    }
    const onSubmit = (e) => {
        e.preventDefault();
        if (user.id) {
          AxiosClient.put(`/users/${id}`,user)
          .then(() => {
            //Todo  show notificaton
            setNotification("data successfully updated");
             navigate('/user');
          })
          .catch((err) => {
            const response = err.response;
            if (response && response.status === 422) {
              setError(response.data.errors)
            }
          })
          
        }else{
          AxiosClient.post(`/users`,user)
          .then(() => {
            //Todo  show notificaton
            setNotification("data successfully created");

             navigate('/user');
          })
          .catch((err) => {
            const response = err.response;
            if (response && response.status === 422) {
              setError(response.data.errors)
            }
          })
        }
    };

    return (
        <>
            {user.id && <h1>Update User{user.name}</h1>}
            {!user.id && <h1>New User</h1>}
            <div className="animated card">
                {loading && <div className="text-center">Loading...</div>}
                {error && (
                    <div className="alert ">
                        {Object.keys(error).map((key) => (
                            <p key={key}>{error[key][0]}</p>
                        ))}
                    </div>
                )}
                {!loading && (
                    <form onSubmit={onSubmit}>
                        <input value={user.name} type="text" onChange={(ev)=>setUser({...user,name:ev.target.value})} placeholder="Name" />
                        <input value={user.email} type="text"onChange={(ev)=>setUser({...user,email:ev.target.value})} placeholder="Email" />
                        <input onChange={(ev)=>setUser({...user,password:ev.target.value})} type="text" placeholder="password" />
                        <input onChange={(ev)=>setUser({...user,password_confirmation:ev.target.value})}  type="text" placeholder="Password confirmation"   />
                        <button className="btn">Submit</button>
                    </form>
                )}
            </div>
        </>
    );
};

export default UserForm;
