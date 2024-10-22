/* eslint-disable react/display-name */
import PropTypes from 'prop-types';
import { useSurveyContext } from "./context/SurveyContext.js";
import SurveySidebar from "./components/SurveySidebar.js";
import ThankYouComponent from "./components/ThankYou.js";
import NavigationControls from "./components/NavigationControls.js";
import useSubmitSurvey from "../../hooks/useSubmitSurvey.js";
import ValidationModal from "./components/ValidationModal.js";
import React, { memo, useState } from 'react';


const SurveyStepPanel = memo(function ({
  currentStep, totalSteps, handlePrevStep, handleNextStep, title, description, children,
}) {

  const { isSubmitted, formValues, setIsSubmitted } = useSurveyContext();
  const { handleSubmit, submitting, submissionError } = useSubmitSurvey();
  const [showErrorModal, setShowErrorModal] = useState(false);

  const validateForm = () => {
    const questions = formValues.survey.questions;
    console.log("Questions:", questions);

    // Check if questions object exists and is not empty
    return questions && Object.keys(questions).length > 0;
  };

  const onFormSubmit = async (event) => {
    event.preventDefault();

    if (!validateForm()) {
      setShowErrorModal(true);
      console.log("showErrorModal", true);
      return;
    }

    const success = await handleSubmit(event);
    if (success) {
      setIsSubmitted(true);
    }
  };

  console.log("showErrorModal", showErrorModal);
  console.log("isSubmitted", isSubmitted);
  return (
    <form onSubmit={onFormSubmit} noValidate>
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


                </>
              )}
              <br></br><br></br><br></br>
            </div>
          </div>
        </div>
      </div>
      <ValidationModal
        isOpen={showErrorModal}
        onClose={() => setShowErrorModal(false)}
        title="Empty Questions"
        description="Please answer all questions before submitting the survey."
      />
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
