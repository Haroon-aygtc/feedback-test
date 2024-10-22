import React, {useMemo} from 'react';
import PropTypes from 'prop-types';
import {QUESTION_TYPES, STARS} from '../../../utils/constants.js';
import {useSurveyContext} from "../context/SurveyContext.js"; // Assuming you have predefined constants

const RatingComponent = ({ step }) => {
    const { formValues, handleInputChange } = useSurveyContext();

    const selectedRating = useMemo(() =>
            formValues.survey.questions[`question_${step.step_number}`]?.answer?.rating || 1,
        [formValues, step.step_number]
    );

    const handleStarClick = (rating) => {
        handleInputChange(step.step_number, QUESTION_TYPES.RATING, rating);
    };

     const renderStar = useMemo(() => (star) => (
        <span
            key={star}
            className={`rate-value ${star <= selectedRating ? 'full-block' : 'full-block-empty'}`}
            style={{ cursor: 'pointer', fontSize: '2rem' }}
        >
        </span>
    ), [selectedRating]);

    return (
        <div className="service-rating" style={{ textAlign: 'center' }}>
            <div className="survey-rating clearfix position-relative">
                <div id="stars" className="starrr">
                    {STARS.map((star) => (
                        <span
                            key={star}
                            onClick={() => handleStarClick(star)}
                        >
                            {renderStar(star)}
                        </span>
                    ))}
                </div>
                <span className="survey-rate-text">
                    You selected <span id="count">{selectedRating}</span> star(s)
                </span>
            </div>
        </div>
    );
};

RatingComponent.propTypes = {
    step: PropTypes.shape({
        step_number: PropTypes.number.isRequired,
    }).isRequired,
};

export default RatingComponent;
