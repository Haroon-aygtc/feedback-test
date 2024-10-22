import React, { useCallback } from 'react';
import FormInput from '../../common/FormInput.js';
import PropTypes from "prop-types";
import { useSurveyContext } from "../context/SurveyContext.js";
import { QUESTION_TYPES } from "../../../utils/constants.js";

const ContactComponent = ({ step }) => {
    const { handleInputChange } = useSurveyContext();

    const handleChange = useCallback((event) => {
        const { name, value } = event.target;
        handleInputChange(step.step_number, QUESTION_TYPES.CONTACT, { [name]: value });
    }, [handleInputChange, step.step_number]);

    const handlePhoneChange = useCallback((event) => {
        const { name, value } = event.target;
        const numericValue = value.replace(/\D/g, '');
        if (numericValue !== value) {
            event.target.value = numericValue;
        }
        handleInputChange(step.step_number, QUESTION_TYPES.CONTACT, { [name]: numericValue });
    }, [handleInputChange, step.step_number]);

    return (
        <div className="service-rating">
            <div className="details-form-area">
                <div className="row">
                    <div className="col-lg-6">
                        <FormInput
                            type="email"
                            name="email"
                            placeholder="Email"
                            icon="envelope"
                            required
                            onChange={handleChange}
                        />
                    </div>
                    
                    <div className="col-lg-6">
                        <FormInput
                            type="tel"
                            name="phone"
                            placeholder="Phone"
                            icon="phone"
                            onChange={handlePhoneChange}
                            onKeyPress={(event) => {
                                if (!/[0-9]/.test(event.key)) {
                                    event.preventDefault();
                                }
                            }}
                            pattern="[0-9]*"
                            inputMode="numeric"
                        />
                    </div>
                </div>
            </div>
        </div>
    );
};

ContactComponent.propTypes = {
    step: PropTypes.shape({
        step_number: PropTypes.number.isRequired,
        email: PropTypes.string,
        phone: PropTypes.string,
    }).isRequired,
};


export default ContactComponent;
