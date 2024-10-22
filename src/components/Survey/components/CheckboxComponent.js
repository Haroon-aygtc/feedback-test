import React from 'react';
import PropTypes from 'prop-types';

const CheckboxComponent = ({ step, currentStep }) => {
    // Memoize the options to avoid unnecessary re-renders
    const options = React.useMemo(() => step.options, [step.options]);

    return (
        <div className="reccomend-selector">
            <ul>
                {options.map(({ value, imgSrc }) => (
                    <li key={value}>
                        <label>
                            <input
                                type="radio"
                                name={`reccomend_select${currentStep}`}
                                value={value}
                                className="exp-option-box"
                                defaultChecked
                            />
                            <span className="exp-label">{value}</span>
                            <span className="checkmark-border"></span>

                            {imgSrc && (
                                <span className="service-review-img">
                                    <img src={imgSrc} alt={value} />
                                </span>
                            )}
                        </label>
                    </li>
                ))}

            </ul>
        </div>
    );
};

CheckboxComponent.propTypes = {
    step: PropTypes.shape({
        options: PropTypes.arrayOf(
            PropTypes.shape({
                value: PropTypes.string.isRequired,
                imgSrc: PropTypes.string
            })
        ).isRequired
    }).isRequired,
    currentStep: PropTypes.number.isRequired
};

export default React.memo(CheckboxComponent);
