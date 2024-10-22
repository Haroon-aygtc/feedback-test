


//
// const componentMap = {
//     radio: RadioComponent,
//     rating: RatingComponent,
//     contact: ContactComponent,
// };
//
// const useQuestionComponent = (step) => {
//     // Memoize the rendered and enhanced component
//     return useMemo(() => {
//         const Component = componentMap[step.type];
//         if (!Component) return null;
//
//         // eslint-disable-next-line no-undef
//         return React.cloneElement(
//             <Component key={step.step_number} step={step} />,
//             {
//             }
//         );
//     }, [step,]);
// };
