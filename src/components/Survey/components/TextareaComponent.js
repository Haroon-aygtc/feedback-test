import React from 'react';
import PropTypes from 'prop-types';
import { useTranslation } from 'react-i18next';

const TextareaComponent = ({ name }) => {
    const { t } = useTranslation();

    return (
        <textarea
            name={name}
            className="survey-textarea"
            placeholder={t( 'survey.additionalMessage')}
        />
    );
};

TextareaComponent.propTypes = {
    name: PropTypes.string.isRequired, // Ensure 'name' prop is a string and required
    placeholderKey: PropTypes.string, // Optional translation key for placeholder
};

export default TextareaComponent;
