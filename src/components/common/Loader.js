import { motion, AnimatePresence } from 'framer-motion';
import logo from '../../assets/images/New Project (2).png';

const FloatingElement = ({ delay }) => {
    const pathVariants = {
        hidden: { pathLength: 0, opacity: 0 },
        visible: {
            pathLength: 1,
            opacity: 1,
            transition: { 
                duration: 2,
                ease: "easeInOut",
                repeat: Infinity,
                repeatType: "reverse",
                delay
            }
        }
    };

    return (
        <motion.svg
            className="absolute"
            style={{
                top: `${Math.random() * 100}%`,
                left: `${Math.random() * 100}%`,
                width: '50px',
                height: '50px'
            }}
            viewBox="0 0 50 50"
        >
            <motion.path
                d="M25 10 L40 40 L10 40 Z"
                stroke="rgba(255, 255, 255, 0.5)"
                strokeWidth="1"
                fill="none"
                variants={pathVariants}
                initial="hidden"
                animate="visible"
            />
        </motion.svg>
    );
};

const Loader = () => {


    const textVariants = {
        hidden: { opacity: 0 },
        visible: { 
            opacity: 1,
            transition: { 
                staggerChildren: 0.08,
                delayChildren: 0.5
            }
        }
    };

    const letterVariants = {
        hidden: { opacity: 0, y: 50 },
        visible: { 
            opacity: 1, 
            y: 0,
            transition: { 
                type: "spring",
                damping: 12,
                stiffness: 200
            }
        }
    };

    const loadingText = "AL YALAYIS";

    return (
        <AnimatePresence>

                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                    className="fixed inset-0 bg-black z-50 flex flex-col items-center justify-center p-4 font-['Jost',sans-serif] overflow-hidden"
                >
                    {[...Array(15)].map((_, index) => (
                        <FloatingElement key={index} delay={index * 0.2} />
                    ))}

                    <motion.img
                        src={logo}
                        alt="Company Logo"
                        className="w-[80vw] h-[80vw] max-w-[400px] max-h-[400px] mb-[5vh] object-contain"
                        initial={{ opacity: 0, scale: 0.5 }}
                        animate={{ opacity: 1, scale: 1 }}
                        transition={{ duration: 1 }}
                    />

                    <motion.div
                        variants={textVariants}
                        initial="hidden"
                        animate="visible"
                        className="flex justify-center mb-[5vh] flex-wrap"
                    >
                        {loadingText.split('').map((char, index) => (
                            <motion.span
                                key={index}
                                variants={letterVariants}
                                className="text-[8vw] sm:text-[6vw] md:text-[4vw] font-bold text-yellow-400 mx-[0.5vw]"
                            >
                                {char}
                            </motion.span>
                        ))}
                    </motion.div>

                    <motion.div 
                        className="w-[90vw] max-w-[800px] h-[8px] bg-yellow-400/30 overflow-hidden mt-[5vh] rounded-full"
                    >
                        <motion.div 
                            className="h-full bg-yellow-400 rounded-full"
                            initial={{ width: 0 }}
                            animate={{ width: "100%" }}
                            transition={{ duration: 4, ease: "linear" }} // Changed from 15 to 4 seconds
                        />
                    </motion.div>

                    <motion.p
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        transition={{ delay: 1.5, duration: 1 }}
                        className="mt-[5vh] text-white text-[3vw] sm:text-[2.5vw] md:text-[2vw] text-center"
                    >
                        Government Transactions Center
                    </motion.p>
                </motion.div>

        </AnimatePresence>
    );
};

export default Loader;