const imageMap = {
    "Very Bad": import('../../assets/emojis/sr1.png'),
    "Bad": import('../../assets/emojis/sr2.png'),
    "Average": import('../../assets/emojis/sr3.png'),
    "Happy": import('../../assets/emojis/sr4.png')
};

export const getImageForOption = (value) => {
    return imageMap[value] || null;
};