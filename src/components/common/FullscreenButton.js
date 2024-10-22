// src/components/FullscreenButton.js
import React from 'react';
import { Maximize2, Minimize2 } from 'lucide-react';
import Fullscreen from '../../hooks/FullScreen.js';

const FullscreenButton = () => {
      const { isFullscreen, toggleFullscreen } = Fullscreen();

      return (
            <button
                  onClick={toggleFullscreen}
                  className="fixed bottom-4 right-4 p-2 rounded-full bg-black/80 hover:bg-black text-white shadow-lg transition-all duration-300 z-50"
                  aria-label={isFullscreen ? 'Exit fullscreen' : 'Enter fullscreen'}
            >
                  {isFullscreen ? (
                        <Minimize2 size={24} />
                  ) : (
                        <Maximize2 size={24} />
                  )}
            </button>
      );
};

export default FullscreenButton;