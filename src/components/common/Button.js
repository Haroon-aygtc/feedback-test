import React, { memo } from 'react';
import PropTypes from 'prop-types';

const Button = memo(({ type, text, onClick, title, buttonType = 'button', className = '', useLi = true }) => {
    const Wrapper = useLi ? 'li' : 'div';

    return (
        <Wrapper>
            <button
                className={`${className} js-btn-${type}`}
                title={title}
                onClick={onClick}
                type={buttonType}
            >
                {text}
            </button>
        </Wrapper>
    );
});

Button.propTypes = {
    type: PropTypes.string.isRequired,
    text: PropTypes.string.isRequired,
    onClick: PropTypes.func,
    title: PropTypes.string.isRequired,
    buttonType: PropTypes.oneOf(['button', 'submit', 'reset']),
    className: PropTypes.string,
    useLi: PropTypes.bool,
};


export default Button;