import React, {useCallback} from 'react';
import FormInput from '../../common/FormInput.js';
import PropTypes from "prop-types";
import {useSurveyContext} from "../context/SurveyContext.js";
import {QUESTION_TYPES} from "../../../utils/constants.js";

const ContactComponent = ({ step }) => {
    const { handleInputChange } = useSurveyContext();

    const handleChange = useCallback((event) => {
        const { name, value } = event.target;
        handleInputChange(step.step_number, QUESTION_TYPES.CONTACT, { [name]: value });
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
                            type="text"
                            name="phone"
                            placeholder="Phone"
                            icon="phone"
                            onChange={handleChange}
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
