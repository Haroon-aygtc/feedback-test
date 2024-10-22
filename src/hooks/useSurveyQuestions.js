import {useState, useEffect, useMemo} from 'react';
import { fetchAllSurveyQuestions } from '../services/dataService.js';
import {useLoading} from "../components/Survey/context/LoadingContext.js";

const useSurveyQuestions = (language) => {
    const [allQuestions, setAllQuestions] = useState([]);
    const [loading, setLoading] = useState(true);
    const { startLoading, stopLoading } = useLoading();

    useEffect(() => {
        const loadQuestions = async () => {
            startLoading();
            setLoading(true);
            try {
                const questions = await fetchAllSurveyQuestions();
                setAllQuestions(questions);
            } catch (error) {
                console.error("Error fetching survey questions:", error);
            } finally {
                stopLoading();
                setLoading(false);
            }
        };

        loadQuestions();
    }, [language, startLoading, stopLoading]);

    // Memoize the filtered questions:
    const filteredQuestions = useMemo(() => {
        return allQuestions.map(question => ({
            ...question,
            translations: question.translations.filter(t => t.locale === language),
            options: question.options.map(option => ({
                ...option,
                translations: option.translations.filter(t => t.locale === language)
            }))
        }));
    }, [allQuestions, language]); // Correct dependencies!

    return { surveyQuestions: filteredQuestions, loading };
};

export default useSurveyQuestions;