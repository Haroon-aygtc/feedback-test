import React from 'react';
import PropTypes from 'prop-types';

const FormInput = ({ type, name, placeholder, icon, required, onChange, value }) => {
    return (

        <div className={`form-input-inner position-relative has-float-label ${required ? 'required' : ''}`}>
            <input
                type={type}
                name={name}
                placeholder={placeholder}
                className="form-control"
                onChange={onChange}
                value={value}
            />
            <div className="icon-bg text-center">
                <i className={`fas fa-${icon}`}></i>
            </div>
        </div>
    );
};

FormInput.propTypes = {
    type: PropTypes.string.isRequired,
    name: PropTypes.string.isRequired,
    placeholder: PropTypes.string.isRequired,
    icon: PropTypes.string.isRequired,
    required: PropTypes.bool,
    onChange: PropTypes.func,
    value: PropTypes.string,
};


export default FormInput;
