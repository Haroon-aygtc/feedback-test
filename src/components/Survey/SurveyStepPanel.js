/* eslint-disable react/display-name */
import PropTypes from 'prop-types';
import {useSurveyContext} from "./context/SurveyContext.js";
import SurveySidebar from "./components/SurveySidebar.js";
import ThankYouComponent from "./components/ThankYou.js";
import NavigationControls from "./components/NavigationControls.js";
import useSubmitSurvey from "../../hooks/useSubmitSurvey.js";
import React, { memo, useEffect } from 'react';

const SurveyStepPanel = memo(function ({
    currentStep, totalSteps, handlePrevStep, handleNextStep, title, description, children,
}) {
    const { isSubmitted } = useSurveyContext();
    const { handleSubmit, submitting, submissionError } = useSubmitSurvey();
    console.log('isSubmitted:', isSubmitted);
    useEffect(() => {
        console.log('isSubmitted changed:', isSubmitted);
        // You can add any logic here that needs to happen 
        // when isSubmitted changes, like closing a modal, etc.
    }, [isSubmitted]);
    return (
        <form onSubmit={handleSubmit} noValidate>
            <div className={`form-panel ${currentStep ? 'active' : ''}`}>
                <div className="job-style-content">
                    <SurveySidebar
                        title={title}
                        description={description}
                        currentStep={currentStep}
                        totalSteps={totalSteps} />
                    <div className="survey-right-area">
                        <div className="survey-content">
                            {isSubmitted ? (
                                <ThankYouComponent />
                            ) : (
                                <>
                                    {children}
                                    <NavigationControls
                                        currentStep={currentStep}
                                        totalSteps={totalSteps}
                                        onPrev={handlePrevStep}
                                        onNext={handleNextStep} />

                  {submitting && <p>Submitting...</p>}
                  {submissionError && <p className="error-message">{submissionError.message}</p>}
                </>
              )}
            </div>
          </div>
        </div>
      </div>
    </form>
  );
});

SurveyStepPanel.propTypes = {
  currentStep: PropTypes.number.isRequired,
  totalSteps: PropTypes.number.isRequired,
  handlePrevStep: PropTypes.func.isRequired,
  handleNextStep: PropTypes.func.isRequired,
  title: PropTypes.string,
  description: PropTypes.string,
  children: PropTypes.node,
};


export default SurveyStepPanel;