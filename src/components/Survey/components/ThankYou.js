import React from 'react';
import PropTypes from 'prop-types';
import { useTranslation } from 'react-i18next';
import Button from '../../common/Button.js';
import { motion } from 'framer-motion';
import { CheckCircle, ArrowRight } from "lucide-react"
const ThankYouComponent = () => {
    const { t } = useTranslation();

    return (
        <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
            <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.8 }}
                className="text-center p-8 bg-amber-300 bg-opacity-50 rounded-2xl shadow-lg max-w-md w-full mx-4 backdrop-blur-sm"
                style={{ backgroundColor: 'rgba(251, 191, 36, 0.5)' }}
            >
                <motion.div
                    initial={{ scale: 0 }}
                    animate={{ scale: 1 }}
                    transition={{ duration: 0.5, delay: 0.2 }}
                    className="mb-6 inline-block"
                >
                    <div className="rounded-full bg-amber-500 p-3">
                        <CheckCircle className="w-12 h-12 text-white" />
                    </div>
                </motion.div>
                <h1 className="text-3xl font-bold mb-4 text-gray-800">Thank You!</h1>
                <p className="text-lg text-gray-700 mb-8">
                    Your feedback is invaluable to us. We appreciate your time and insights in completing our survey.
                </p>

            </motion.div>
        </div>
    )
};

ThankYouComponent.propTypes = {
    message: PropTypes.string,
};

export default ThankYouComponent;
