import axios from 'axios';
import { CONFIG } from '../utils/constants.js';


export const fetchAllSurveyQuestions = async () => {
    try {
        const response = await axios.get(`${CONFIG.API_BASE_URL}/questions`); // Use your correct API endpoint
        return response.data;
    } catch (error) {
        return [];
    }
};

export const submitSurveyResponses = async (data) => {
    try {
        const response = await axios.post(`${CONFIG.API_BASE_URL}/submit-survey`, data);
        return response.data;
    } catch (error) {
        console.error('Error submitting survey:', error);
        throw error;
    }
};