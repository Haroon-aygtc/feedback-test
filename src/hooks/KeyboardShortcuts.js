// src/hooks/useKeyboardShortcuts.js
import { useEffect } from 'react';
import useFullscreen from './FullScreen.js';

const KeyboardShortcuts = () => {
  const { enterFullscreen, exitFullscreen, isFullscreen } = useFullscreen();

  useEffect(() => {
    const handleKeyDown = (event) => {
      // F11 key for fullscreen
      if (event.key === 'F11') {
        event.preventDefault();
        if (isFullscreen) {
          exitFullscreen();
        } else {
          enterFullscreen();
        }
      }

      // Alt + Enter for fullscreen
      if (event.key === 'Enter' && event.altKey) {
        event.preventDefault();
        if (isFullscreen) {
          exitFullscreen();
        } else {
          enterFullscreen();
        }
      }
    };

    document.addEventListener('keydown', handleKeyDown);
    return () => document.removeEventListener('keydown', handleKeyDown);
  }, [isFullscreen, enterFullscreen, exitFullscreen]);
};

export default KeyboardShortcuts;