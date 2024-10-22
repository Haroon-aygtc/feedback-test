import PropTypes from 'prop-types';
import { useTranslation } from "react-i18next";
import { useSurveyContext } from "../context/SurveyContext.js";
import { CONFIG } from "../../../utils/constants.js";
import { useCallback, useMemo, useState } from 'react'; // Import useMemo

const RadioComponent = ({step}) => {
    const {i18n} = useTranslation();
    const {formValues, handleInputChange} = useSurveyContext();
    const language = i18n.language;
    const [selectedOption, setSelectedOption] = useState(null);

    const handleChange = useCallback((event) => {
        const selectedId = Number(event.target.value);
        setSelectedOption(selectedId); // Update the selectedOption state
        handleInputChange(step.step_number, 'radio', selectedId); // Pass the selected option
    }, [handleInputChange, step.step_number]);

    const renderedOptions = useMemo(() => {
        const translatedOptions = step.options.map((option) => {
            const translatedOption = option.translations.find(
                (translation) => translation.locale === language
            );
            const translatedImgSrc = translatedOption?.image_path;
            const imgSrc = translatedImgSrc ? `${CONFIG.IMG_BASE_URL}${translatedImgSrc}` : null;
            const translatedOptionText = translatedOption?.option_text;

            return <label key={option.id}
                   className={selectedOption === option.id ? 'selected' : ''}
            >
                <input
                    type="radio"
                    name={`survey_step_${step.step_number}`}
                    className="ser_rev"
                    value={option.id}
                    checked={selectedOption === option.id}
                    onChange={handleChange}
                    aria-label={translatedOptionText}
                />
                {imgSrc && <span className="service-review-img">
                        <img src={imgSrc} alt={translatedOptionText}/>
                    </span>}
                <span className="review_select"></span>
                <span className="service-review-text text-capitalize">
                    {translatedOptionText}
                </span>
            </label>;
        });

        if (translatedOptions.some(option => option === null)) {
            console.error("Error: Missing translation data in RadioComponent");
            return null;
        }

        return translatedOptions;

    }, [step.options, language, selectedOption, handleInputChange, step.step_number]); // setDataError removed


    return (
        <div className="service-review">
            {renderedOptions}
        </div>
    );
};

RadioComponent.propTypes = {
    step: PropTypes.shape({
        step_number: PropTypes.number.isRequired,
        options: PropTypes.arrayOf(PropTypes.shape({
            id: PropTypes.number.isRequired,
            translations: PropTypes.arrayOf(PropTypes.shape({
                locale: PropTypes.string.isRequired,
                option_text: PropTypes.string.isRequired,
                image_path: PropTypes.string
            })).isRequired
        })).isRequired,
    }).isRequired,
};
export default RadioComponent;