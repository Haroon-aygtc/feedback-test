import React from 'react';
import PropTypes from 'prop-types';
import { useTranslation } from 'react-i18next';
import thankyou from '../../../assets/images/chth.png';

const ThankYouComponent = () => {
    const { t } = useTranslation(); // Translation support

    return (
        <div className="poll-thank-text text-center">

            <img src={thankyou} alt="Thank You" />
            <h3>{ t('survey.thankYou')}</h3>

        </div>
    );
};

ThankYouComponent.propTypes = {
    message: PropTypes.string,
};

export default ThankYouComponent;
